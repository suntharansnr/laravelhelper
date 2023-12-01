<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Route;
use App\Metatag;
use App\Models\Noty;
use Auth;
use DataTables;
use App\Notifications\NewPermission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;
class PermissionsController extends Controller
{
  function __construct()
        {
            //  $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
            //  $this->middleware('permission:permission-create', ['only' => ['create','store']]);
            //  $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
            //  $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
            //  $this->middleware('permission:permission-status', ['only' => ['Status_Update']]);
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $routeName = Route::currentRouteName();
        // $meta_tag = Metatag::where('route', '=', $routeName)->firstOrFail();
        if ($request->ajax()){
                              $data = Permission::query();
                              return Datatables::of($data)
                                      ->addIndexColumn()
                                      ->addColumn('action', function($row){
                                            $btn = '<a href="javascript:void(0)" class="btn btn-warning btn-sm editPermission" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
                                            $btn = $btn."&nbsp; ".'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-times"></i></a>';
                                            return $btn;
                                      })
                                      ->rawColumns(['action'])
                                      ->make(true);
                              }
                              return view('admin.permissions.permission'
                              // ,compact('meta_tag'
                              );
    }
    public function store(Request $request)
    {
      if($request->id == null)
      {
        $validator = Validator::make($request->all(), [
          'name' => 'required|unique:permissions,name',
        ]);
      }
      else{
        $id = $request->get('id');
        $validator = Validator::make($request->all(), [
          'name' => 'required|unique:permissions,name,'.$id,
        ]);
      }  
      if($validator->passes())
      {  
      if($request->id == null)
      {
        $permission = Permission::updateOrCreate(['id' => $request->id],
        [
          'name' => $request->name,
        ]);
        // if($request->id == null) {
        //   $added_by_permission = Auth::user();
        //   $permission1 = Permission::whereNotIn('id',[$added_by_permission->id])->get();
        //     foreach ($permission1 as $notifiable_id) {
        //         $notifiable_id->notify(new NewPermission($added_by_permission,$permission));
        //     }
        // }
      }
      else{
        $permission = Permission::updateOrCreate(['id' => $request->id],
        [
          'name' => $request->name,
        ]);
      }
        return json_encode(['permission' => $permission]);
      }
      else{
        return response()->json(['error'=>$validator->errors()->all()]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
        return view('admin.permissions.ajax.view',compact('permission'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
     if ($request->isMethod('get'))
        {
          $permission = Permission::find($id);
          return response()->json($permission);
        }
    }

    public function destroy($id)
    {
      $check = Permission::find($id)->roles()->count();
      if($check > 0) {
                return response()->json(['msg'=>'relation_error']);
      }
      Permission::find($id)->delete();
      //  Return response
      return response()->json(['success'=>'Permission deleted successfully.']);
    }
}