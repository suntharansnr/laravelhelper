<?php

namespace App\Http\Controllers;
use App\Tag;
use App\Metatag;
use App\Models\User;
use Route;
use Auth;
use DataTables;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function __construct()
        {
             $this->middleware('permission:tag-list|tag-create|tag-edit|tag-delete', ['only' => ['index','store']]);
             $this->middleware('permission:tag-create', ['only' => ['create','store']]);
             $this->middleware('permission:tag-edit', ['only' => ['edit','update']]);
             $this->middleware('permission:tag-delete', ['only' => ['destroy']]);
             $this->middleware('permission:tag-status', ['only' => ['Status_Update']]);
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
       if(Auth::user()->role_id > 1){
           return redirect()->route('accessdenied');
       }
       //
       if ($request->ajax()){
                             $data = Tag::all();
                             return Datatables::of($data)
                                     ->addIndexColumn()
                                     ->addColumn('action', function($row){
                                           $btn = '<a href="javascript:void(0)" class="btn btn-warning btn-sm editUser" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
                                           $btn = $btn."&nbsp; ".'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-times"></i></a>';
                                           if ($row->amenities_status == 1) {
                                             $btn = $btn."&nbsp; ".'<input data-id="'.$row->id.'" checked id="status_update" class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                                           }
                                           else {
                                           $btn = $btn."&nbsp; ".'<input data-id="'.$row->id.'" id="status_update" class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                                           }
                                           return $btn;
                                     })
                                     ->rawColumns(['action'])
                                     ->make(true);
                             }
                             return view('tag.tag',compact('tags','meta_tag'));
   }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $tag = Tag::updateOrCreate(['id' => $request->id],
              ['name' => $request->name,'amenities_type' => $request->amenities_type]);
      return response()->json(['success'=>'Tag saved successfully.']);
  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */

  public function edit($id)

  {
      $tag = Tag::find($id);
      return response()->json($tag);
  }



  /**

   * Remove the specified resource from storage.

   *

   * @param  \App\Product  $product

   * @return \Illuminate\Http\Response

   */

  public function destroy($id)

  {
      Product::find($id)->delete();
      return response()->json(['success'=>'Product deleted successfully.']);
  }

  public function Status_Update(request $request)
  {
    if(Auth::user()->role_id > 1){
        return redirect()->route('accessdenied');
    }

    $Theme = Theme::find($request->Theme_id);
    $Theme->status = $request->Theme_status;
    $Theme->save();

    $Theme = Theme::find($request->Theme_id);

//      return response()->json(['success'=>'Status change successfully.','user'=>'$user']);

    return json_encode(['Theme' => $Theme]);
  }
}
