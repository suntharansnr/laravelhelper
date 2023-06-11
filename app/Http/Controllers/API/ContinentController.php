<?php
namespace App\Http\Controllers\API;
use App\Continent;
use App\Models\User;
use Auth;
use Route;
use App\Metatag;
use DataTables;
use DB;
use Carbon\Carbon;
use App\Photo;
use App\Notifications\NewContinent;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\Continent as ContinentResource;

class ContinentController extends BaseController
{
  function __construct()
  {
       $this->middleware('permission:continent-list|continent-create|continent-edit|continent-delete', ['only' => ['index','store']]);
       $this->middleware('permission:continent-create', ['only' => ['create','store']]);
       $this->middleware('permission:continent-edit', ['only' => ['edit','update']]);
       $this->middleware('permission:continent-delete', ['only' => ['destroy']]);
       $this->middleware('permission:continent-status', ['only' => ['Status_Update']]);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    if(Auth::user()->isAdmin()) {
      $continent=Continent::paginate(12);
    }
    else {
      $continent=Continent::whereuser_id(Auth::user()->id)->paginate(12);
                 
    }
      return view('admin.continent.index',compact('meta_tag'));
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
        'contient_name' => 'unique:continents,contient_name'
      ]);

      if($validator->passes()){
             if(Auth::user()->isAdmin()){
              $input['status'] = "Accept";
            }
             $input['user_id'] = Auth::user()->id;
             $continent = continent::create($input);

             $added_by_user = Auth::user();
             $user1 = User::whereNotIn('id',[$added_by_user->id])->get();
               foreach ($user1 as $notifiable_id) {
                   $notifiable_id->notify(new Newcontinent($added_by_user,$continent));
               }

             return response()->json([
                                        'fail' => false,
                                        'redirect_url' => url('continent')
                                    ]);
      }else{
        return response()->json(['error'=>$validator->errors()->all()]);
      }
    }

    public function edit($id)
    {
         $properties=continent::findorFail($id);

         return response()->json(
                                array(
                                'prop' => $properties,
                                )
                                );
    }
    public function update(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'contient_name' => 'unique:continents,contient_name,'.$request->id
      ]); 
      if($validator->passes())
      {
               $continent = Continent::findorFail($request->id);
               $input = $request->all();
               $input['user_id'] = Auth::user()->id;
               $continent->update($input);
               return response()->json();       
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
    public function delete($id)
    {
      $continent = Continent::find($id);
      if($continent->countries()->count() > 0 || $continent->radios()->count() > 0)
      {
        return response()->json( ['msg' => 'relation_error'] );
      }
      else{
        $continent->delete();
        return response()->json( ['msg' => 'success'] );
      }
    }

   public function Request(Request $request,$id)
   {
     $continent = Continent::find($id);
     $continent->status = $request->status;
     $continent->save();

     $continent = continent::find($id);

     return response()->json();
   }


}
