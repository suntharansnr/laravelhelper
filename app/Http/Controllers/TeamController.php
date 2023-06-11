<?php
namespace App\Http\Controllers;
use App\Team;
use File;
use Image;
use Auth;
use Route;
use App\Metatag;
use DataTables;
use DB;
use Carbon\Carbon;
use Thumbnail;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamController extends Controller
{
  function __construct()
        {
             $this->middleware('permission:team-list|team-create|team-edit|team-delete', ['only' => ['index','store']]);
             $this->middleware('permission:team-create', ['only' => ['create','store']]);
             $this->middleware('permission:team-edit', ['only' => ['edit','update']]);
             $this->middleware('permission:team-delete', ['only' => ['destroy']]);
             $this->middleware('permission:team-status', ['only' => ['Status_Update']]);
        }
 function file_get_contents_curl($url) {
   $ch = curl_init();

   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_URL, $url);

   $data = curl_exec($ch);
   curl_close($ch);

   return $data;
 }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
     {
      $routeName = Route::currentRouteName();
      $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();
      if( Auth::check() ){
        if (Auth::user()->role_id == 2) {

 
         }
        else {
      if ($request->ajax()){
      $data=Team::all();
                 return Datatables::of($data)
                         ->addIndexColumn()
                         ->addColumn('content', function($row){
                               $content = Str::limit($row->content, 50);
                               return $content;
                           })
                         ->addColumn('image', function($row){
                               $image = '<img src="'.$row->img_path.'" width="70" class="img-thumbnail"/>';
                               return $image;
                           })
                         ->addColumn('action', function($row){
                               $btn = '<a href="javascript:void(0)" class="btn btn-warning btn-sm editUser" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
                               $btn = $btn."&nbsp; ".'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-times"></i></a>';
                               $btn = $btn."&nbsp; ".'<a role="button" href="#modalForm" class="btn btn-info btn-sm" data-toggle="modal" data-href="team/show/'.$row->id.'" data-backdrop="static" data-keyboard="false"><i class="fa fa-exclamation"></i></a>';
                               if ($row->status == 1) {
                                   $btn = $btn."&nbsp; ".'<input data-id="'.$row->id.'" checked id="status_update" class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                               }
                               else {
                               $btn = $btn."&nbsp; ".'<input data-id="'.$row->id.'" id="status_update" class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                               }
                               return $btn;
                         })
                         ->escapeColumns(['content'])
                         ->rawColumns(['action','content','image'])
                         ->make(true);
                       }
         }
                               return view('team.index',compact('meta_tag'));
  }
      return view('auth.login');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             ini_set('memory_limit','2048M');
             $input = $request->all();
               //check if image exist
               if ($request->hasFile('image')) {
                   $image = $request->file('image');
                   //setting flag for condition
                   $org_img = true;

                   // create new directory for uploading image if doesn't exist
                   if( ! File::exists('teams/originals/')) {
                       $org_img = File::makeDirectory('teams/originals/', 0777, true);
                   }
                       //get file name of image  and concatenate with 4 random integer for unique
                       $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
                       //path of image for upload
                       $org_path = 'teams/originals/' . $filename;

                       $input['img_path'] = 'teams/originals/'.$filename;
                       //don't upload file when unable to save name to database


                       // upload image to server
                       if (($org_img) == true) {
                          // resize the image to a height of 200 and constrain aspect ratio (auto width)
                          Image::make($image)->save($org_path);
                       }
               }
             $teams = Team::create($input);

             return response()->json([
                                        'fail' => false,
                                        'redirect_url' => url('team')
                                    ]);
    }

    public function edit($id)
    {
         $testimonials=team::findorFail($id);

         return response()->json(
                                array(
                                'prop' => $testimonials,
                                )
                                );
    }
    public function update(Request $request)
    {
               ini_set('memory_limit','2048M');

               $testimonial = Team::find($request->id);

               ini_set('memory_limit','2048M');
               $input = $request->all();
               $input['user_id'] = Auth::user()->id;
                 //check if image exist
                 if ($request->hasFile('image')) {
                     $image = $request->file('image');
                     //setting flag for condition
                     $org_img = true;

                     // create new directory for uploading image if doesn't exist
                     if( ! File::exists('teams/originals/')) {
                         $org_img = File::makeDirectory('teams/originals/', 0777, true);
                     }
                         //get file name of image  and concatenate with 4 random integer for unique
                         $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
                         //path of image for upload
                         $org_path = 'teams/originals/' . $filename;

                         $input['img_path'] = 'teams/originals/'.$filename;
                         //don't upload file when unable to save name to database


                         // upload image to server
                         if (($org_img) == true) {
                            // resize the image to a height of 200 and constrain aspect ratio (auto width)
                            if (file_exists($testimonial->img_path))
                            {
                            unlink($testimonial->img_path);
                            }
                            Image::make($image)->save($org_path);
                         }
                 }

               $testimonial->update($input);

               return response()->json([
                                          'fail' => false,
                                          'redirect_url' => url('team')
                                      ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $testimonial=Team::findorFail($id);
        if (Auth::user()->role_id == 1) {
         return view('team.ajax.show',compact('testimonial'));
        } else {
          return view('users.accessdenied');
        }
    }
    public function delete($id)
    {
      $testimonial = Team::find($id);
      if (file_exists($testimonial->img_path))
      {
         unlink($testimonial->img_path);
      }
      $testimonial->delete();
      return response()->json(['success'=>'team details deleted successfully.']);
    }


   public function Status_Update(request $request)
   {
     if(Auth::user()->role_id > 1){
         return redirect()->route('accessdenied');
     }

     $testimonial = Team::find($request->user_id);
     $testimonial->status = $request->status;
     $testimonial->save();

     $testimonial = Team::find($request->user_id);

//      return response()->json(['success'=>'Status change successfully.','user'=>'$user']);

     return json_encode(['testimonial' => $testimonial]);
   }


}
