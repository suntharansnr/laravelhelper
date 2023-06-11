<?php
namespace App\Http\Controllers\API;
use App\State;
use App\Models\User;
use App\Role;
use App\Country;
use Auth;
use Route;
use App\Metatag;
use App\Notifications\NewState;
use DataTables;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\State as StateResource;

class StateController extends BaseController
{
  function __construct()
        {
             $this->middleware('permission:state-list|state-create|state-edit|state-delete', ['only' => ['index','store']]);
             $this->middleware('permission:state-create', ['only' => ['create','store']]);
             $this->middleware('permission:state-edit', ['only' => ['edit','update']]);
             $this->middleware('permission:state-delete', ['only' => ['destroy']]);
             $this->middleware('permission:state-status', ['only' => ['Status_Update']]);
        }
    public function index(Request $request)
    {
      if(Auth::user()->isAdmin()) {
        $state = State::paginate(10);
        return $this->sendResponse(['state'=>StateResource::collection($state)],'Data retrived successfully.');
      }
      else{
        $state = State::whereuser_id(Auth::user()->id)
                      ->paginate(10);
        return $this->sendResponse(['state' => StateResource::collection($state)],'Data retrived successfully.');
      }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             $input = $request->all();
             $validator = Validator::make($input, [
               'name' => 'unique:states,name'
             ]);
       
             if($validator->passes()){
              if(Auth::user()->isAdmin()){
                $input['status'] = "Accept";
              }
              $input['user_id'] = Auth::user()->id;
              $State = State::create($input);
 
              $added_by_user = Auth::user();
              $user1 = User::whereNotIn('id',[$added_by_user->id])->get();
                foreach ($user1 as $notifiable_id) {
                    $notifiable_id->notify(new NewState($added_by_user,$State));
                }
              return $this-> sendResponse(['state'=> new StateResource($state)] , 'data saved successfuly');
              }
             else{
               return $this->sendError('Validation Error.', $validator->errors());
             }
    }

    public function edit($id)
    {
         $state=State::findorFail($id);

         return $this->sendResponse(new StateResource($state),'Data retrived successfully.');
    }
    public function update(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'unique:states,name,'.$request->id
      ]); 
      if($validator->passes())
      {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $State = State::findorFail($request->id);
        $State->update($input);

        return $this->sendResponse(['state' =>new StateResource($state)],'state updated successfully.');
      }else{
        return $this->sendError('Validation Error.', $validator->errors());
      }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
      $State = State::find($id);
      if($State->cities()->count() > 0 || $State->radios()->count() > 0)
      {
        return response()->json( ['msg' => 'relation_error'] );
      }
      else{
        $State->delete();
        return $this->sendResponse(['state'=> new StateResource($State)],'state deleted successfully' );
      }
    }

   public function Request(Request $request,$id)
   {
     $State = State::find($id);
     $State->status = $request->status;
     $State->save();

     $State = State::find($id);

     return response()->json();
   }


}
