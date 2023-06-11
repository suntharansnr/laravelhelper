<?php
namespace App\Http\Controllers\API;
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
use App\Http\Resources\Category as CategoryResource;
use Validator;

class CategoryController extends BaseController
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
      $allcategories = Category::all();
      $categories = Category::where('parent_id', '=', 0)->get();
      return $this->sendResponse(['allcategories' => CategoryResource::collection($allcategories) , 'categories' => CategoryResource::collection($categories)] ,'Data retrieved successfully.');
  }

    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
         'name' => 'required|unique:categories,name'
      ]);
      if ($validator->passes()){
        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        $category = Category::create($input);
        return $this->sendResponse(new CategoryResource($category),'New category added successfully.');
      }
      else{
        return $this->sendError('Validation Error.', $validator->errors());
      }
    }

    public function edit($id)
    {
         $categories=Category::findorFail($id);
         return $this->sendResponse(new CategoryResource($categories) , 'Data retrived successfully.');
    }
    public function update(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required|unique:categories,name,'.$request->id,
      ]);

      if($validator->passes()){
      $category = Category::findorFail($request->id);
      $category->name = $request->name;
      $category->save();
      return $this->sendResponse(new CategoryResource($category),'Category updated successfully.');
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
      $category = category::findorFail($id);
      if(count($category->childs)){
        return $this->sendResponse(new CategoryResource($category) , 'cannot delete category');
      }else{
        $category->delete();
        return $this->sendResponse( ['category' => new CategoryResource($category)], 'category deleted successfully' );
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
