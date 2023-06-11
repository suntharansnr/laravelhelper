<?php
namespace App\Http\Controllers\API;
use App\About;
use App\Models\User;
use App\Role;
use App\Category;
use File;
use Image;
use Auth;
use Route;
use App\Metatag;
use App\Notifications\Newabout;
use DataTables;
use DB;
use Carbon\Carbon;
use Thumbnail;
use VideoThumbnail;
use App\Photo;
use App\services\Slugabout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use OpenGraph;
use App\Http\Resources\About as AboutResource;
use App\Http\Resources\Category as CategoryResource;
use Validator;

class AboutController extends BaseController
{
  function __construct()
  {
         $this->middleware('permission:about-list|about-create|about-edit|about-delete', ['only' => ['index','store']]);
         $this->middleware('permission:about-create', ['only' => ['create','store']]);
         $this->middleware('permission:about-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:about-delete', ['only' => ['destroy']]);
         $this->middleware('permission:about-status', ['only' => ['Status_Update']]);
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $about=about::with('category')
                ->get();
      return $this->sendResponse( ['about'=>AboutResource::collection($about)] , 'data retrived successfuly' );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'image' => 'mimes:jpeg,bmp,png',
      ]);
      if($validator->passes()){
        ini_set('memory_limit','2048M');
        $input = $request->all();
          //check if image exist
          if ($request->hasFile('image')) {
              $image = $request->file('image');
              //setting flag for condition
              $org_img = true;

              // create new directory for uploading image if doesn't exist
              if( ! File::exists('abouts/originals/')) {
                  $org_img = File::makeDirectory('abouts/originals/', 0777, true);
              }
                  //get file name of image  and concatenate with 4 random integer for unique
                  $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
                  //path of image for upload
                  $org_path = 'abouts/originals/' . $filename;

                  $input['img_path'] = 'abouts/originals/'.$filename;
                  //don't upload file when unable to save name to database


                  // upload image to server
                  if (($org_img) == true) {
                     // resize the image to a height of 200 and constrain aspect ratio (auto width)
                     Image::make($image)->resize(1280, 720)->save($org_path);
                  }
          }

        $slug = new Slugabout();
        $input['slug'] = $slug->createSlug($request->title);
        $about = about::create($input);

        $added_by_user = Auth::user();
        $user1 = User::whereNotIn('id',[$added_by_user->id])->get();
          foreach ($user1 as $notifiable_id) {
              $notifiable_id->notify(new Newabout($added_by_user,$about));
          }
          return $this->sendResponse([], 'Data added successfully.');
        }else{
          return $this->sendError('Validation Error.', $validator->errors());       
      }
    }

    public function edit($id)
    {
         $abouts=about::findorFail($id);
         return $this->sendResponse(new AboutResource($abouts), 'Data retrived successfully.');
    }

    public function update(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'image' => 'mimes:jpeg,bmp,png',
      ]);
      if($validator->passes()){
        ini_set('memory_limit','2048M');

               $about = about::find($request->id);

               ini_set('memory_limit','2048M');
               $input = $request->all();
               if ($about->title != $request->title) {
                 $slug = new Slugabout();
                 $input['slug'] = $slug->createSlug($request->title);
               }

               $input['user_id'] = Auth::user()->id;
                 //check if image exist
                 if ($request->hasFile('image')) {
                     $image = $request->file('image');
                     //setting flag for condition
                     $org_img = true;

                     // create new directory for uploading image if doesn't exist
                     if( ! File::exists('abouts/originals/')) {
                         $org_img = File::makeDirectory('abouts/originals/', 0777, true);
                     }
                         //get file name of image  and concatenate with 4 random integer for unique
                         $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
                         //path of image for upload
                         $org_path = 'abouts/originals/' . $filename;

                         $input['img_path'] = 'abouts/originals/'.$filename;
                         //don't upload file when unable to save name to database


                         // upload image to server
                         if (($org_img) == true) {
                            // resize the image to a height of 200 and constrain aspect ratio (auto width)
                            Image::make($image)->resize(1280, 720)->save($org_path);
                         }
                 }

               $about->update($input);

               return $this->sendResponse(new AboutResource($about), 'About updated successfully.');
      }
      else{
          return $this->sendError('Validation Error.', $validator->errors());       
      }            
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $about=about::findorFail($id);
      $pro = $about;
      $user_id = $pro->user_id;
        if ($user_id == Auth::user()->id || Auth::user()->isAdmin()) {
          return $this->sendResponse(new AboutResource($about), 'Data retrived successfully.');
        } else {
          return $this->sendResponse([], 'Access denied.');
        }
    }
    public function delete($id)
    {
      $about = about::find($id);
      if (file_exists($about->img_path))
      {
         unlink($about->img_path);
      }
      $about->delete();
      return $this->sendResponse([], 'About deleted successfully.');
    }


   public function Status_Update(request $request)
   {
     if(!Auth::user()->isAdmin()){
       return $this->sendResponse([], 'Access denied.');
     }

     $about = About::find($request->user_id);
     $about->status = $request->status;
     $about->save();

     $about = About::find($request->user_id);

     return $this->sendResponse(new AboutResource($about));
   }


}
