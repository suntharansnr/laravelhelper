<?php
namespace App\Http\Controllers\API;
use App\city;
use App\Models\User;
use App\Role;
use App\Country;
use App\State;
use Auth;
use Route;
use App\Metatag;
use App\Notifications\Newcity;
use DataTables;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\City as CityResource;

class CityController extends BaseController
{
  function __construct()
    {
         $this->middleware('permission:city-list|city-create|city-edit|city-delete', ['only' => ['index','store']]);
         $this->middleware('permission:city-create', ['only' => ['create','store']]);
         $this->middleware('permission:city-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:city-delete', ['only' => ['destroy']]);
         $this->middleware('permission:city-status', ['only' => ['Status_Update']]);
    }
    public function index(Request $request)
    {
    if(Auth::user()->isAdmin()) 
      {
      $city=City::paginate(10);
      }
    else 
      {
      $city=City::whereuser_id(Auth::user()->id)->paginate(10);              
      }
      return $this->sendResponse(['city' => CityResource::collection($city)] , 'data retrived successfuly');
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
              'name' => 'unique:cities,name'
            ]);
            if($validator->passes()){
              if(Auth::user()->isAdmin()){
                $input['status'] = "Accept";
              }
  
               $input['user_id'] = Auth::user()->id;
               $city = city::create($input);
  
               $added_by_user = Auth::user();
               $user1 = User::whereNotIn('id',[$added_by_user->id])->get();
                 foreach ($user1 as $notifiable_id) {
                     $notifiable_id->notify(new Newcity($added_by_user,$city));
                 }
  
               return $this->sendResponse(new CityResource($city) , 'Data added successfully.');
            }
            else{
              return $this->sendError('Validation Error.', $validator->errors());  
            }
    }

    public function edit($id)
    {
         $cities=city::findorFail($id);
         return $this->sendResponse(new CityResource($cities) , 'Data retrived successfully.');
    }
    
    public function update(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'unique:cities,name,'.$request->id
      ]); 
      if($validator->passes())
      {
      $input = $request->all();
      $input['user_id'] = Auth::user()->id;
      $city = city::findorFail($request->id);
      $city->update($input);
        return $this->sendResponse(new CityResource($city), 'city updated successfully.');
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
      $city = city::find($id);
      if($city->radios()->count() > 0)
      {
        return response()->json( ['msg' => 'relation_error'] );
      }
      else{
        $city->delete();
        return $this->sendResponse(new CityResource($city),'city deleted successfully'); 
      }
    }

   public function Request(Request $request,$id)
   {
     $city = city::find($id);
     $city->status = $request->status;
     $city->save();

     $city = city::find($id);

     return response()->json();
   }
}
