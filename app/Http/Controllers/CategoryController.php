<?php
namespace App\Http\Controllers;
use App\Category;
use App\Models\User;
use Auth;
use Route;
use App\Metatag;
use App\Notifications\NewPost;
use DataTables;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  function __construct()
  {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','store']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
        $this->middleware('permission:category-status', ['only' => ['Status_Update']]);
  }
    public function index(Request $request)
     {
      $routeName = Route::currentRouteName();
      $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();
      if( Auth::check() ){
    if (!Auth::user()->isAdmin()) {
      if ($request->ajax()){
      $allcategories = Category::all();
      $data=Category::all();
                 return Datatables::of($data)
                         ->addIndexColumn()
                         ->addColumn('status', function($row){
                                       if ($row->status == 1) {
                                         $btn = '<badge class="badge badge-success">Active</badge>';
                                       }
                                       else {
                                       $btn = "&nbsp; ".'<badge class="badge badge-success">In active</badge>';
                                       }
                                       return $btn;
                         })
                         ->addColumn('action', function($row){
                               $btn = '<badge class="badge badge-danger">Access denied</badge>';
                               return $btn;
                         })
                         ->rawColumns(['status','change_status','action'])
                         ->make(true);
                       }
         }
    else {
      $allcategories = Category::all();
      $categories = Category::where('parent_id', '=', 0)->get();
      if ($request->ajax()){
      $data=Category::all();
                 return Datatables::of($data)
                         ->addIndexColumn()
                         ->addColumn('status', function($row){
                                       if ($row->status == 1) {
                                         $btn = "&nbsp; ".'<input data-id="'.$row->id.'" checked id="status_update" title="cant update logged in user status" class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                                       }
                                       else {
                                       $btn = "&nbsp; ".'<input data-id="'.$row->id.'" id="status_update" title="cant update logged in user status" class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                                       }
                                       return $btn;
                         })
                         ->addColumn('action', function($row){
                               $btn = '<a href="javascript:void(0)" class="btn btn-warning btn-sm editUser" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
                               $btn = $btn."&nbsp; ".'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-times"></i></a>';
                               return $btn;
                         })
                         ->rawColumns(['status','change_status','action'])
                         ->make(true);
                       }
         }
                               return view('admin.category.treeview',compact('meta_tag','allcategories','categories'));
  }
      return view('auth.login');

    }

    public function store(Request $request)
    {
             $input = $request->all();
             $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
             $category = Category::create($input);
             return response()->json($category);
    }

    public function edit($id)
    {
         $categories=Category::findorFail($id);
         return response()->json(
                                array(
                                'prop' => $categories,
                                )
                                );
    }
    public function update(Request $request)
    {
               $category = Category::findorFail($request->id);
               $category->name = $request->name;
               $category->save();
               return response()->json([
                                          'fail' => false,
                                          'redirect_url' => url('Post')
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
      $Post=DB::table('categories')
                 ->join('photos','photos.Post_id','=','categories.id')
                 ->select('categories.*','photos.image')
                 ->where('Post_id','=',$id)
                 ->where('banner','=','1')
                 ->get();
     $pro = $Post[0];

     $user_id = $pro->user_id;
       if ($user_id == Auth::user()->id || Auth::user()->category_id == 1) {
        return view('Post.ajax.show',compact('Post','pro'));
       } else {
         return view('users.accessdenied');
       }
}
    public function delete($id)
    {
      $category = category::find($id);
      if(count($category->childs)){
        return response()->json(['error'=>'true',$category]);
      }else{
        $category->delete();
        return response()->json(['success'=>'true',$category]);
      }
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

   public function Status_Update(request $request)
   {
     if(Auth::user()->category_id > 1){
         return redirect()->route('accessdenied');
     }

     $category = Category::find($request->user_id);
     $category->status = $request->user_status;
     $category->save();

     $category = Category::find($request->user_id);
     return json_encode(['category' => $category]);
   }

}
