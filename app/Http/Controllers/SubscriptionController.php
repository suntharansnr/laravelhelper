<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Route;
use App\Metatag;
use App\Models\Subscription;
use Auth;
use DataTables;
use App\Notifications\NewUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Validator;
class SubscriptionController extends Controller
{
  function __construct()
        {
             $this->middleware('permission:subscription-list|subscription-create|subscription-edit|subscription-delete', ['only' => ['index','store']]);
             $this->middleware('permission:subscription-create', ['only' => ['create','store']]);
             $this->middleware('permission:subscription-edit', ['only' => ['edit','update']]);
             $this->middleware('permission:subscription-delete', ['only' => ['destroy']]);
             $this->middleware('permission:subscription-status', ['only' => ['Status_Update']]);
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $routeName = Route::currentRouteName();
        $meta_tag = Metatag::where('route', '=', $routeName)->firstOrFail();
        if ($request->ajax()){
                              $data = Subscription::query();
                              return Datatables::of($data)
                                      ->addIndexColumn()
                                      ->addColumn('action', function($row){
                                            $btn = '<a href="javascript:void(0)" class="btn btn-warning btn-sm editUser" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
                                            if ($row->id == Auth::user()->id) {
                                                $btn = $btn."&nbsp; ".'<button type="button" class="btn btn-danger btn-sm" name="button" disabled title="cant delete logged in user"><i class="fa fa-times"></i></button>';
                                            } else {
                                                $btn = $btn."&nbsp; ".'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-times"></i></a>';
                                            }
                                            if ($row->id == Auth::user()->id) {
                                                        if ($row->user_status == 1) {
                                                          $btn = $btn."&nbsp; ".'<input data-id="'.$row->id.'"  checked id="status_update" title="cant update logged in user status" disabled class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                                                        }
                                                        else {
                                                        $btn = $btn."&nbsp; ".'<input data-id="'.$row->id.'" id="status_update" title="cant update logged in user status" disabled class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                                                        }
                                            }
                                            else {
                                                        if ($row->user_status == 1) {
                                                          $btn = $btn."&nbsp; ".'<input data-id="'.$row->id.'" checked id="status_update" class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                                                        }
                                                        else {
                                                        $btn = $btn."&nbsp; ".'<input data-id="'.$row->id.'" id="status_update" class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                                                        }
                                            }

                                            return $btn;
                                      })
                                      ->rawColumns(['action','position'])
                                      ->make(true);
                              }
                              return view('admin.subscribers.index',compact('meta_tag'));
    }
    public function store(Request $request)
    {
      if($request->id == null)
      {
        $validator = Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required|email|unique:users,email',
          'roles' => 'required'
        ]);
      }
      else{
        $id = $request->get('id');
        $validator = Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required|email|unique:users,email,'.$id,
          'roles' => 'required'
        ]);
      }  
      if($validator->passes())
      {  
      if($request->id == null)
      {
        $password = bcrypt($request->password);
        $user = User::updateOrCreate(['id' => $request->id],
        [
          'roles' => $request->roles,
          'name' => $request->name,
          'email' => $request->email,
          'password' => $password,
        ]);
        $user->assignRole($request->input('roles'));
        if($request->id == null) {
          $added_by_user = Auth::user();
          $user1 = User::whereNotIn('id',[$added_by_user->id])->get();
            foreach ($user1 as $notifiable_id) {
                $notifiable_id->notify(new NewUser($added_by_user,$user));
            }
          }
      }
      else{
        $user = User::updateOrCreate(['id' => $request->id],
        [
          'roles' => $request->roles,
          'name' => $request->name,
          'email' => $request->email,
        ]);
        $user->assignRole($request->input('roles'));
      }
        return json_encode(['user' => $user]);
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
        $user = User::find($id);
        return view('admin.subscribers.ajax.view',compact('user'));

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
          $user = User::find($id);
          $user['role_name'] = $user->getRoleNames()->first();
          return response()->json($user);
        }
    }

    public function destroy($id)
    {
      $subscription = Subscription::find($id)->delete();
      //  Return response
      return response()->json(['success'=>'Subscription deleted successfully.']);
    }

    public function Status_Update(request $request)
    {
      $user = User::find($request->user_id);
      $user->user_status = $request->user_status;
      $user->save();

      $user = User::find($request->user_id);
      return json_encode(['user' => $user]);
    }

    public function notifications()
    {
        return auth()->user()->unreadNotifications()->toArray();
    }

    public function AdminNotifications(Request $request){
        $notifications = DB::table('notifications')
                           ->where('type','=','App\\Notifications\\NewUserVisit')
                           ->where('notifiable_id',Auth::user()->id)
                           ->orderBy('created_at','DESC')
                           ->get();
        if ($request->ajax()){
          $data = $notifications;
          return Datatables::of($data)
                  ->addIndexColumn()
                  ->addColumn('id', function( $row){
                        return $row->id;
                  })
                  ->addColumn('message', function( $row){
                    $message_data = json_decode($row->data, true);
                    return 'New user visit on your post '.'<a href="/blog/'.$message_data['slug'].'">'.$message_data['slug'].'</a>';
                  })
                  ->addColumn('time', function( $row){
                    $time = Carbon::parse($row->created_at)->diffForHumans();
                    return $time;
                  })
                  ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="btn btn-warning btn-sm editUser" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
                        if ($row->id == Auth::user()->id) {
                            $btn = $btn."&nbsp; ".'<button type="button" class="btn btn-danger btn-sm" name="button" disabled title="cant delete logged in user"><i class="fa fa-times"></i></button>';
                        } else {
                            $btn = $btn."&nbsp; ".'<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-times"></i></a>';
                        }
                        $btn = $btn."&nbsp; ".'<a role="button" href="#modalForm" class="btn btn-info btn-sm" data-toggle="modal" data-href="users/show/'.$row->id.'" data-backdrop="static" data-keyboard="false"><i class="fa fa-exclamation"></i></a>';
                        if ($row->id == Auth::user()->id) {
                                    if (1) {
                                      $btn = $btn."&nbsp; ".'<input data-id="'.$row->id.'"  checked id="status_update" title="cant update logged in user status" disabled class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                                    }
                                    else {
                                    $btn = $btn."&nbsp; ".'<input data-id="'.$row->id.'" id="status_update" title="cant update logged in user status" disabled class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                                    }
                        }
                        else {
                                    if (1) {
                                      $btn = $btn."&nbsp; ".'<input data-id="'.$row->id.'" checked id="status_update" class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                                    }
                                    else {
                                    $btn = $btn."&nbsp; ".'<input data-id="'.$row->id.'" id="status_update" class="toggle-class btn-sm" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" data-size="small">';
                                    }
                        }

                        return $btn;
                  })
                  ->rawColumns(['message','action','position'])
                  ->make(true);
          }
          return view('admin.subscribers.notifications');
    }
}