<?php
namespace App\Http\Controllers\API;
use App\Country;
use App\Models\User;
use Auth;
use Route;
use App\Metatag;
use App\Notifications\NewCountry;
use DataTables;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Continent;
use Validator;
use App\Http\Resources\Country as CountryResource;

class CountryController extends BaseController
{
  function __construct()
    {
         $this->middleware('permission:country-list|country-create|country-edit|country-delete', ['only' => ['index','store']]);
         $this->middleware('permission:country-create', ['only' => ['create','store']]);
         $this->middleware('permission:country-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:country-delete', ['only' => ['destroy']]);
         $this->middleware('permission:country-status', ['only' => ['Status_Update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if(Auth::user()->isAdmin()) {
        $countries=Country::paginate(12);
      }
      else{
      $data=Country::whereuser_id(Auth::user()->id)->paginate(12);
      }
      return $this->sendResponse(['countries' => CountryResource::collection($countries)], 'data retrived successfuly');
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
        'name' => 'unique:countries,name'
      ]);

      if($validator->passes()){
        if(Auth::user()->isAdmin()){
          $input['status'] = "Accept";
        }
        $input['user_id'] = Auth::user()->id;
        $Country = Country::create($input);

        $added_by_user = Auth::user();
        $user1 = User::whereNotIn('id',[$added_by_user->id])->get();
          foreach ($user1 as $notifiable_id) {
              $notifiable_id->notify(new NewCountry($added_by_user,$Country));
          }
        return $this->sendResponse(['country' => new CountryResource($Country)],'New country added successfully.');
      }
      else{
        return $this->sendError('Validation Error.', $validator->errors());
      }
    }

    public function edit($id)
    {
         $country=Country::with('continent')->findorFail($id);
         return $this->sendResponse(['country' => new CountryResource($country)],'Data retrieved successfully.');
    }
    public function update(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'unique:countries,name,'.$request->id
      ]); 
      if($validator->passes())
      {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $country = Country::findorFail($request->id);
        $country->update($input);
        return $this->sendResponse(['country' => new CountryResource($country)],'Data updated successfully.');
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
      $country = Country::find($id);
      if($country->states()->count() > 0 || $country->radios()->count() > 0)
      {
        return response()->json( ['msg' => 'relation_error'] );
      }
      else{
        $country->delete();
        return $this->sendResponse(['country' => new CountryResource($country)],'Country deleted successfully.');
      }

    }

   public function Request(Request $request,$id)
   {
     $country = Country::find($id);
     $country->status = $request->status;
     $country->save();

     $country = Country::find($id);

     return response()->json();
   }


}
