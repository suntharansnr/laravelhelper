<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Route;
use App\Metatag;
use Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Validator;
Use File;
Use Image;
Use Carbon\Carbon;
Use Thumbnail;
use Redirect,Response;
class ProfileController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }
    public function show()
    {
      $routeName = Route::currentRouteName();
      $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();
      return view('admin.profile.view',compact('meta_tag'));
    }


    public function updateprofile(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.Auth::user()->id,
        'image' => 'mimes:jpeg,bmp,png'
      ]);

      if($validator->passes()){
        $user = User::find(Auth::user()->id);
        ini_set('memory_limit','2048M');
        $input = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            //setting flag for condition
            $org_img = true;
  
            // create new directory for uploading image if doesn't exist
            if( ! File::exists('storage/images/UserOriginal/')) {
                $org_img = File::makeDirectory('storage/images/UserOriginal/', 0777, true);
            }
                //get file name of image  and concatenate with 4 random integer for unique
                $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
                //path of image for upload
                $org_path = 'storage/images/UserOriginal/' . $filename;
                $input['profile_photo_path'] = 'storage/images/UserOriginal/'.$filename;
        }
        
        $user1 = $user->update($input);
  
        if ($request->hasFile('image')) {
                //don't upload file when unable to save name to database
                if (!$user) {
                    return false;
                }
  
                // upload image to server
                if (($org_img) == true) {
                   Image::make($image)->save($org_path);
                }
              }
        $updated_user = User::findorFail(Auth::user()->id);
        return response()->json($updated_user);
      }
      else{
        return response()->json(['error'=>$validator->errors()->all()]);
      }
    }


    public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        $notification = array(
                               'message' => 'Password updated successfully!',
                               'alert-type' => 'success'
                             );
        return redirect()->back()->with($notification);
    }
}
