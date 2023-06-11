<?php
namespace App\Http\Controllers;
use App\Theme;
use Auth;
use DataTables;
use DB;
use App\Metatag;
Use File;
Use Image;
Use Carbon\Carbon;
Use Thumbnail;
use Route;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    function __construct()
        {
             $this->middleware('permission:theme-list|theme-create|theme-edit|theme-delete', ['only' => ['index','store']]);
             $this->middleware('permission:theme-create', ['only' => ['create','store']]);
             $this->middleware('permission:theme-edit', ['only' => ['edit','update']]);
             $this->middleware('permission:theme-delete', ['only' => ['destroy']]);
             $this->middleware('permission:theme-status', ['only' => ['Status_Update']]);
        }
  public function index(Request $request)
  {
      $routeName = Route::currentRouteName();
      $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();

      $theme = Theme::firstOrFail();
      if ($request->ajax()) {
         return view('admin.theme.ajax',compact('theme'));
      }
      if (Auth::user()->isAdmin()) {
          return view('admin.theme.view',compact('theme','meta_tag'));
        }
        else{
          return view('users.accessdenied',compact('theme','meta_tag'));
      }
  }

  public function store(Request $request)
  {
    $input = $request->all();
    ini_set('memory_limit','2048M');
    //check if image exist
    $old_image = Theme::find(1)->logo;
    $welcome_banner_old_image = Theme::find(1)->welcome_banner;
    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        //setting flag for condition
        $org_img = true;

        // create new directory for uploading image if doesn't exist
        if( ! File::exists('storage/images/logo/')) {
            $org_img = File::makeDirectory('storage/images/logo/', 0777, true);
        }
            //get file name of image  and concatenate with 4 random integer for unique
            $filename = rand(1111,9999).time().'.'.$logo->getClientOriginalExtension();
            //path of image for upload
            $org_path = 'storage/images/logo/' . $filename;
            $input['logo'] = $org_path;
    }

    if ($request->hasFile('welcome_banner')) {
        $welcome_banner = $request->file('welcome_banner');
        //setting flag for condition
        $welcome_banner_org_img = true;

        // create new directory for uploading image if doesn't exist
        if( ! File::exists('storage/images/welcome_banner/')) {
            $welcome_banner_org_img = File::makeDirectory('storage/images/welcome_banner/', 0777, true);
        }
            //get file name of image  and concatenate with 4 random integer for unique
            $filename1 = rand(1111,9999).time().'.'.$welcome_banner->getClientOriginalExtension();
            //path of image for upload
            $org_path1 = 'storage/images/welcome_banner/' . $filename1;
            $input['welcome_banner'] = $org_path1;
    }
    $theme = Theme::find($request->id);
    $theme->update($input);


              if ($request->hasFile('logo')) {
                      //don't upload file when unable to save name to database
                      //don't upload file when unable to save name to database
                      if (!$theme) {
                          return false;
                      }

                      // upload image to server
                      if ($org_img == true) {

                         //delete old image from storage directory
                         if(file_exists($old_image))
                         {
                           unlink($old_image);
                         }
                         Image::make($logo)->save($org_path);
                      }
                    }

                    if ($request->hasFile('welcome_banner')) {
                            //don't upload file when unable to save name to database
                            //don't upload file when unable to save name to database
                            if (!$theme) {
                                return false;
                            }

                            // upload image to server
                            if ($welcome_banner_org_img == true) {

                               //delete old image from storage directory
                               if(file_exists($welcome_banner_old_image))
                               {
                                 unlink($welcome_banner_old_image);
                               }
                               Image::make($welcome_banner)->save($org_path1);
                            }
                          }

      return response()->json(['success'=>'Theme url saved successfully.']);
  }

  public function edit()
  {
      $theme = Theme::firstOrFail();
      if(request()->ajax()){
               return response()->json($theme);
      }
  }
}
