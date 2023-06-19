<?php
namespace App\Http\Controllers;
use App\Post;
use App\Models\User;
use App\Role;
use App\Category;
use File;
use Image;
use Auth;
use Route;
use App\Metatag;
use App\Notifications\NewPost;
use DataTables;
use DB;
use Carbon\Carbon;
use Thumbnail;
use VideoThumbnail;
use App\Photo;
use App\services\slug;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use OpenGraph;
use Validator;

class PostController extends Controller
{
  function __construct()
        {
             $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index','store']]);
             $this->middleware('permission:post-create', ['only' => ['create','store']]);
             $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
             $this->middleware('permission:post-delete', ['only' => ['destroy']]);
             $this->middleware('permission:post-status', ['only' => ['Status_Update']]);
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

      $users = User::all();
      $categories = Category::wherestatus("1")->get();
      if (Auth::user()->isAdmin()) {
      if ($request->ajax()){
      $data=Post::query();
                 return Datatables::of($data)
                         ->addIndexColumn()
                         ->addColumn('content', function($row){
                             $content = Str::limit($row->content, 50);
                             return $content;
                           })
                         ->addColumn('category', function($row){
                             $category = $row->category ? $row->category->name : '-';
                             return $category;
                           })
                         ->addColumn('posted_by', function($row){
                             $posted_by = $row->user ? $row->user->name : '-';
                             return $posted_by;
                           })
                         ->addColumn('status', function($row){
                               if ($row->status == 'Accept') {
                                 $btn = '<span class="badge badge-success">Live</span>';
                                 return $btn;
                               } elseif ($row->status == 'Draft') {
                                 $btn = '<span class="badge badge-info">Draft</span>';
                                 return $btn;
                               } elseif ($row->status == 'Request_to_publish'){
                                 $btn = '<span class="badge badge-warning">Requested</span>';
                                 return $btn;
                               } else{
                                 $btn = '<span class="badge badge-danger">Denied</span>';
                                 return $btn;
                               }

                         })
                         ->addColumn('change_status', function($row){
                          if ($row->status == 'Accept') {
                            $btn = '<div class="btn-group" role="group">
                                <a id="btnGroupDrop1" role="button" href="#" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="width:100px !important">
                                      <button type="button" class="btn dropdown-item request" data-id="'.$row->id.'" data-status="Deny">Deny</button>
                                </div>
                            </div>';
                            return $btn;
                          }else{
                            $btn = '<div class="btn-group" role="group">
                                <a id="btnGroupDrop1" role="button" href="#" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="width:100px !important">
                                      <button type="button" class="btn dropdown-item request" data-id="'.$row->id.'" data-status="Accept">Live</button>
                                </div>
                            </div>';
                            return $btn;
                               }

                         })
                         ->addColumn('action', function($row){
                               $btn = '<a href="javascript:void(0)" class="btn btn-warning btn-sm editUser" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
                               $btn = $btn."&nbsp; ".'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-times"></i></a>';
                               $btn = $btn."&nbsp; ".'<a role="button" href="#modalForm" class="btn btn-info btn-sm" data-toggle="modal" data-href="post/show/'.$row->id.'" data-backdrop="static" data-keyboard="false"><i class="fa fa-exclamation"></i></a>';
                               return $btn;
                         })
                         ->escapeColumns(['content'])
                         ->rawColumns(['category','content','posted_by','status','change_status','action'])
                         ->make(true);
                       }
         }
    else {
      if ($request->ajax()){
      $data=Post::with('category')
                ->with('user')
                ->get();
                 return Datatables::of($data)
                         ->addIndexColumn()
                         ->addColumn('content', function($row){
                             $content = Str::limit($row->content, 50);
                             return $content;
                           })
                         ->addColumn('category', function($row){
                             $category = $row->category->name;
                             return $category;
                           })
                         ->addColumn('posted_by', function($row){
                             $posted_by = $row->user->First_Name. '-' .$row->user->Last_Name;
                             return $posted_by;
                           })
                         ->addColumn('status', function($row){
                               if ($row->status == 'Accept') {
                                 $btn = '<span class="badge badge-success">Live</span>';
                                 return $btn;
                               } elseif ($row->status == 'Draft') {
                                 $btn = '<span class="badge badge-info">Draft</span>';
                                 return $btn;
                               } elseif ($row->status == 'Request_to_publish'){
                                 $btn = '<span class="badge badge-warning">Requested</span>';
                                 return $btn;
                               } else{
                                 $btn = '<span class="badge badge-danger">Denied</span>';
                                 return $btn;
                               }

                         })
                         ->addColumn('change_status', function($row){
                          if ($row->status == 'Accept') {
                            $btn = '<div class="btn-group" role="group">
                                <a id="btnGroupDrop1" role="button" href="#" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="width:100px !important">
                                      <button type="button" class="btn dropdown-item request" data-id="'.$row->id.'" data-status="Draft">Draft</button>
                                </div>
                            </div>';
                            return $btn;
                          } elseif ($row->status == 'Draft') {
                            $btn = '<div class="btn-group" role="group">
                                <a id="btnGroupDrop1" role="button" href="#" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="width:100px !important">
                                      <button type="button" class="btn dropdown-item request" data-id="'.$row->id.'" data-status="Request_to_publish">Request</button>
                                </div>
                            </div>';
                            return $btn;
                          } elseif ($row->status == 'Request_to_publish'){
                            $btn = '<div class="btn-group" role="group">
                                <a id="btnGroupDrop1" role="button" href="#" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="width:100px !important">
                                      <button type="button" class="btn dropdown-item request" data-id="'.$row->id.'" data-status="Draft">Draft</button>
                                </div>
                            </div>';
                            return $btn;
                          } else{
                            $btn = '<div class="btn-group" role="group">
                                <a id="btnGroupDrop1" role="button" href="#" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="width:100px !important">
                                      <button type="button" class="btn dropdown-item request" data-id="'.$row->id.'" data-status="Request_to_publish">Request</button>
                                      <button type="button" class="btn dropdown-item request" data-id="'.$row->id.'" data-status="Draft">Draft</button>
                                </div>
                            </div>';
                            return $btn;                              
                               }

                         })
                         ->addColumn('action', function($row){
                               $btn = '<a href="javascript:void(0)" class="btn btn-warning btn-sm editUser" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
                               $btn = $btn."&nbsp; ".'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-times"></i></a>';
                               $btn = $btn."&nbsp; ".'<a role="button" href="#modalForm" class="btn btn-info btn-sm" data-toggle="modal" data-href="post/show/'.$row->id.'" data-backdrop="static" data-keyboard="false"><i class="fa fa-exclamation"></i></a>';
                               return $btn;
                         })
                         ->escapeColumns(['content'])
                         ->rawColumns(['category','content','posted_by','status','change_status','action'])
                         ->make(true);
                       }
         }
                      return view('admin.post.index',compact('categories','meta_tag'));
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
        'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime',
      ]);
      if($validator->passes()){
        ini_set('memory_limit','2048M');
        $input = $request->all();
        $slug = new Slug();
        if($request->post_type == 'post_with_image') {
          //check if image exist
          if ($request->hasFile('image')) {
              $image = $request->file('image');
              //setting flag for condition
              $org_img = true;

              // create new directory for uploading image if doesn't exist
              if( ! File::exists('posts/originals/')) {
                  $org_img = File::makeDirectory('posts/originals/', 0777, true);
              }
                  //get file name of image  and concatenate with 4 random integer for unique
                  $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
                  //path of image for upload
                  $org_path = 'posts/originals/' . $filename;

                  $input['img_path'] = 'posts/originals/'.$filename;
                  $input['user_id'] = Auth::user()->id;
                  $input['slug'] = $slug->createSlug($request->title);
                  //don't upload file when unable to save name to database


                  // upload image to server
                  if (($org_img) == true) {
                     // resize the image to a height of 200 and constrain aspect ratio (auto width)
                     Image::make($image)->resize(1280, 720)->save($org_path);
                  }
          }
        }
        elseif ($request->post_type == 'post_with_video') {
          //check if image exist
          if ($request->hasFile('video')) {
              $video = $request->file('video');
              //setting flag for condition
              $org_video = true;

              // create new directory for uploading image if doesn't exist
              if( ! File::exists('posts/originals/')) {
                  $org_video = File::makeDirectory('posts/originals/', 0777, true);
              }
                  //get file name of image  and concatenate with 4 random integer for unique
                  $filename = rand(1111,9999).time().'.'.$video->getClientOriginalExtension();
                  //path of image for upload
                  $org_path = 'posts/originals/';

                  $input['video_path'] = 'posts/originals/'.$filename;
                  $input['user_id'] = Auth::user()->id;
                  $input['slug'] = $slug->createSlug($request->title);
                  //don't upload file when unable to save name to database


                  // upload image to server
                  if (($org_video) == true) {
                     // resize the image to a height of 200 and constrain aspect ratio (auto width)
                     $video->move($org_path,$filename);
                  }
          }
        }
        else {
          $data1 = OpenGraph::fetch($request->url, true);

          if ( array_key_exists("image",$data1) && !array_key_exists("og:image",$data1) && !array_key_exists("twitter:image",$data1)) {
            $url = $data1['image'];
          }
          elseif ( !array_key_exists("image",$data1) && !array_key_exists("og:image",$data1) && array_key_exists("twitter:image",$data1) ) {
            $url = $data1['twitter:image'];
          } elseif ( !array_key_exists("image",$data1) && array_key_exists("og:image",$data1) && !array_key_exists("twitter:image",$data1) ) {
            $url = $data1['og:image'];
          } elseif ( array_key_exists("image",$data1) && array_key_exists("og:image",$data1) && !array_key_exists("twitter:image",$data1 )) {
            $url = $data1['og:image'];
          } elseif ( !array_key_exists("image",$data1) && array_key_exists("og:image",$data1) && array_key_exists("twitter:image",$data1 )) {
            $url = $data1['og:image'];
          }elseif ( array_key_exists("image",$data1) && !array_key_exists("og:image",$data1) && array_key_exists("twitter:image",$data1 )) {
            $url = $data1['image'];
          }elseif ( !array_key_exists("image",$data1) && !array_key_exists("og:image",$data1) && !array_key_exists("twitter:image",$data1 )) {
            $url = "";
          }else{
            $url = $data1['image'];
          }

          if ($url != "") {
          //setting flag for condition
          $org_img = true;

          // create new directory for uploading image if doesn't exist
          if( ! File::exists('posts/originals/')) {
              $org_img = File::makeDirectory('posts/originals/', 0777, true);
          }
          //get file name of image  and concatenate with 4 random integer for unique
          $filename = rand(1111,9999).time().'-'.substr($url, strrpos($url, '/') + 1);
          //path of image for upload
          $org_path = 'posts/originals/' . $filename;
          $data = $this->file_get_contents_curl($url);
          file_put_contents( $org_path, $data );
          $input['img_path'] = $org_path;
          }

          if ( array_key_exists("description",$data1) && !array_key_exists("og:description",$data1) && !array_key_exists("twitter:description",$data1)) {
            $description = $data1['description'];
          }
          elseif ( !array_key_exists("description",$data1) && !array_key_exists("og:description",$data1) && array_key_exists("twitter:description",$data1) ) {
            $description = $data1['twitter:description'];
          } elseif ( !array_key_exists("description",$data1) && array_key_exists("og:description",$data1) && !array_key_exists("twitter:description",$data1) ) {
            $description = $data1['og:description'];
          } elseif ( array_key_exists("description",$data1) && array_key_exists("og:description",$data1) && !array_key_exists("twitter:description",$data1 )) {
            $description = $data1['og:description'];
          } elseif ( !array_key_exists("description",$data1) && array_key_exists("og:description",$data1) && array_key_exists("twitter:description",$data1 )) {
            $description = $data1['og:description'];
          }elseif ( array_key_exists("description",$data1) && !array_key_exists("og:description",$data1) && array_key_exists("twitter:description",$data1 )) {
            $description = $data1['description'];
          }elseif ( !array_key_exists("description",$data1) && !array_key_exists("og:description",$data1) && !array_key_exists("twitter:description",$data1 )) {
            $description = "";
          }else{
            $description = $data1['description'];
          }

          $input['slug'] = $slug->createSlug($request->title);

          if ($description == "") {
            $input['content'] = Null;
          } else {
            $input['content'] = $description;
          }
          $input['user_id'] = Auth::user()->id;
        }
        $post = Post::create($input);

        $added_by_user = Auth::user();
        $user1 = User::whereNotIn('id',[$added_by_user->id])->get();
          foreach ($user1 as $notifiable_id) {
              $notifiable_id->notify(new NewPost($added_by_user,$post));
          }

        return response()->json();
      }
      else{
          return response()->json(['error'=>$validator->errors()->all()]);
      }
    }

    public function edit($id)
    {
         $properties=Post::findorFail($id);

         return response()->json(
                                array(
                                'prop' => $properties,
                                )
                                );
    }
    public function update(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'image' => 'mimes:jpeg,bmp,png',
        'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime',
      ]);
      if($validator->passes()){
        ini_set('memory_limit','2048M');

        $post = Post::find($request->id);

        ini_set('memory_limit','2048M');
        $input = $request->all();
        if ($post->title != $request->title) {
          $slug = new Slug();
          $input['slug'] = $slug->createSlug($request->title);
        }

        $input['user_id'] = Auth::user()->id;
        if($request->post_type == 'post_with_image') {
          //check if image exist
          if ($request->hasFile('image')) {
              $image = $request->file('image');
              //setting flag for condition
              $org_img = true;

              // create new directory for uploading image if doesn't exist
              if( ! File::exists('posts/originals/')) {
                  $org_img = File::makeDirectory('posts/originals/', 0777, true);
              }
                  //get file name of image  and concatenate with 4 random integer for unique
                  $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();
                  //path of image for upload
                  $org_path = 'posts/originals/' . $filename;

                  $input['img_path'] = 'posts/originals/'.$filename;
                  //don't upload file when unable to save name to database


                  // upload image to server
                  if (($org_img) == true) {
                     // resize the image to a height of 200 and constrain aspect ratio (auto width)
                     Image::make($image)->resize(1280, 720)->save($org_path);
                  }
          }
        }
        elseif ($request->post_type == 'post_with_video') {
          //check if image exist
          if ($request->hasFile('video')) {
              $video = $request->file('video');
              //setting flag for condition
              $org_video = true;

              // create new directory for uploading image if doesn't exist
              if( ! File::exists('posts/originals/')) {
                  $org_video = File::makeDirectory('posts/originals/', 0777, true);
              }
                  //get file name of image  and concatenate with 4 random integer for unique
                  $filename = rand(1111,9999).time().'.'.$video->getClientOriginalExtension();
                  //path of image for upload
                  $org_path = 'posts/originals/';

                  $input['video_path'] = 'posts/originals/'.$filename;
                  //don't upload file when unable to save name to database


                  // upload image to server
                  if (($org_video) == true) {
                     // resize the image to a height of 200 and constrain aspect ratio (auto width)
                     $video->move($org_path,$filename);
                  }
          }
        }
        else {
          $data1 = OpenGraph::fetch($request->url, true);

          if ( array_key_exists("image",$data1) && !array_key_exists("og:image",$data1) && !array_key_exists("twitter:image",$data1)) {
            $url = $data1['image'];
          }
          elseif ( !array_key_exists("image",$data1) && !array_key_exists("og:image",$data1) && array_key_exists("twitter:image",$data1) ) {
            $url = $data1['twitter:image'];
          } elseif ( !array_key_exists("image",$data1) && array_key_exists("og:image",$data1) && !array_key_exists("twitter:image",$data1) ) {
            $url = $data1['og:image'];
          } elseif ( array_key_exists("image",$data1) && array_key_exists("og:image",$data1) && !array_key_exists("twitter:image",$data1 )) {
            $url = $data1['og:image'];
          } elseif ( !array_key_exists("image",$data1) && array_key_exists("og:image",$data1) && array_key_exists("twitter:image",$data1 )) {
            $url = $data1['og:image'];
          }elseif ( array_key_exists("image",$data1) && !array_key_exists("og:image",$data1) && array_key_exists("twitter:image",$data1 )) {
            $url = $data1['image'];
          }elseif ( !array_key_exists("image",$data1) && !array_key_exists("og:image",$data1) && !array_key_exists("twitter:image",$data1 )) {
            $url = "";
          }else{
            $url = $data1['image'];
          }

          if ($url != "") {
          //setting flag for condition
          $org_img = true;

          // create new directory for uploading image if doesn't exist
          if( ! File::exists('posts/originals/')) {
              $org_img = File::makeDirectory('posts/originals/', 0777, true);
          }
          //get file name of image  and concatenate with 4 random integer for unique
          $filename = rand(1111,9999).time().'-'.substr($url, strrpos($url, '/') + 1);
          //path of image for upload
          $org_path = 'posts/originals/' . $filename;
          $data = $this->file_get_contents_curl($url);
          file_put_contents( $org_path, $data );
          $input['img_path'] = $org_path;
          }

          if ( array_key_exists("description",$data1) && !array_key_exists("og:description",$data1) && !array_key_exists("twitter:description",$data1)) {
            $description = $data1['description'];
          }
          elseif ( !array_key_exists("description",$data1) && !array_key_exists("og:description",$data1) && array_key_exists("twitter:description",$data1) ) {
            $description = $data1['twitter:description'];
          } elseif ( !array_key_exists("description",$data1) && array_key_exists("og:description",$data1) && !array_key_exists("twitter:description",$data1) ) {
            $description = $data1['og:description'];
          } elseif ( array_key_exists("description",$data1) && array_key_exists("og:description",$data1) && !array_key_exists("twitter:description",$data1 )) {
            $description = $data1['og:description'];
          } elseif ( !array_key_exists("description",$data1) && array_key_exists("og:description",$data1) && array_key_exists("twitter:description",$data1 )) {
            $description = $data1['og:description'];
          }elseif ( array_key_exists("description",$data1) && !array_key_exists("og:description",$data1) && array_key_exists("twitter:description",$data1 )) {
            $description = $data1['description'];
          }elseif ( !array_key_exists("description",$data1) && !array_key_exists("og:description",$data1) && !array_key_exists("twitter:description",$data1 )) {
            $description = "";
          }else{
            $description = $data1['description'];
          }

          if ($description == "") {
            $input['content'] = Null;
          } else {
            $input['content'] = $description;
          }
        }
        $post->update($input);

        return response()->json([
                                   'fail' => false,
                                   'redirect_url' => url('Post')
                               ]);
      }else{
          return response()->json(['error'=>$validator->errors()->all()]);
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
      $post=Post::findorFail($id);
      $pro = $post;
      $user_id = $pro->user_id;
        if ($user_id == Auth::user()->id || Auth::user()->isAdmin()) {
         return view('admin.post.ajax.show',compact('post','pro'));
        } else {
          return view('users.accessdenied');
        }
    }
    public function delete($id)
    {
      $post = Post::find($id);
      if ($post->post_type == "post_with_video") {
        if (file_exists($post->video_path))
        {
           unlink($post->video_path);
        }
      }
      if (file_exists($post->img_path))
      {
         unlink($post->img_path);
      }
      $post->delete();
      return response()->json(['success'=>'Post deleted successfully.']);
    }

   public function Request(Request $request,$id)
   {
     $Post = Post::find($id);
     $Post->status = $request->status;
     $Post->save();

     $Post = Post::find($id);

//      return response()->json(['success'=>'Status change successfully.','user'=>'$user']);

     return response()->json(['success'=>'User deleted successfully.']);
   }


}
