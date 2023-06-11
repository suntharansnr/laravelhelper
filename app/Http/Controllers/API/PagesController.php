<?php
namespace App\Http\Controllers\API;
use DB;
use App\Models\User;
use App\Comment;
use App\Contact;
use App\Theme;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Route;
use App\Metatag;
use Event;
use App\Report;
use App\Favorite;
use App\Events\ActionDone;
use Carbon\Carbon;
use Auth;
use App\Post;
use App\About;
use App\Testimonial;
use App\Faq;
use App\Country;
use App\State;
use App\City;
use App\Team;
use App\Radio;
use App\Continent;
use App\Category;
use App\services\getchild;
use Illuminate\Support\Arr;
use App\services\helper;
use App\Language;
use Session;
use Illuminate\Support\Str;
use App\Http\Resources\Radio as RadioResource;
use App\Http\Resources\Testimonial as TestimonialResource;
use App\Http\Resources\Contact as ContactResource;
use App\Http\Resources\About as AboutResource;
use App\Http\Resources\Faq as FaqResource;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\Continent as ContinentResource;
use App\Http\Resources\Country as CountryResource;
use App\Http\Resources\State as StateResource;
use App\Http\Resources\City as CityResource;
use App\Http\Resources\Language as LanguageResource;

class PagesController extends BaseController
{
  //this is the view showing the search view
  public function getsearch(Request $request){
  
    $routeName = Route::currentRouteName();
    $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();  
    
    //popular station in your area 
    $helper = new Helper();
    $country_model = $helper->get_client_country_model();
    $popular_station = $country_model->radios()->orderByDesc('visit_count')->limit(12)->get();
    //popular station end
  
    return view('front.pages.search',compact('meta_tag','popular_station'));
  }
  
  public function postsearch(Request $request){
    if($request->ajax())
    {
     $output = '';
     $query = $request->get('query');
     if($query != '')
     {
      $data = DB::table('radios')
        ->where('name', 'like', '%'.$query.'%')
        ->orWhere('description', 'like', '%'.$query.'%')
        ->orderBy('visit_count', 'desc')
        ->get();
        $total_row = $data->count();
        if($total_row > 0)
        {
         foreach($data as $row)
         {
          $output .= '
          <div class="row">
             <div class="col-lg-2 col-md-3">
                <div class="card">
                  <img src=" '.$row->logo.' " class="img-fluid">
                  <div class="card-img-overlay d-flex justify-content-center">
                    <button type="button" class="btn btn-default btn-xl btn-circle play-station play align-self-center" id="'.$row->id.'" data-id="'.$row->id.'" data-name="'.$row->name.'" data-url=" '.$row->stream_url.'"> <i class="fas fa-play"></i> </button>
                  </div>
                </div>
             </div>
             <a href=" '.route('radio.view', $row->name).'">
             <div class="col-lg-10 col-md-9  my-auto pt-3">
                       <h5 style="color:#261630;font-weight:600" >'.$row->name.'</h5>
                       <p style="color:#261630"> '.(Str::limit($row->description,100)).'</p>
             </div>
             </a>
          </div>
          <hr>
          ';
         }
        }
        else
        {
         $output = '
         <tr>
          <td align="center" colspan="5">No Data Found</td>
         </tr>
         ';
        }
        $data = array(
         'table_data'  => $output,
         'total_data'  => $total_row
        );
     }
     else
     {
      $data = '';
     }
  
     echo json_encode($data);
    }
  }

  //this will be used as home
  public function radios(){
    //popular station in your area 
    $helper = new Helper();
    $country_model = $helper->get_client_country_model();
    $popular_station = $country_model->radios()->orderByDesc('visit_count')->limit(12)->get();
    //popular station end
      
    //local radio 
    $local_radio = $country_model->radios()->orderByDesc('visit_count')->limit(12)->get();
      
    //Recently visited station
    if(session()->get('recently_viewed')){
      $recently_visited_id = array_reverse(session()->get('recently_viewed'));
      $recently_visited_id = array_unique($recently_visited_id);
      $tempStr = implode(',', $recently_visited_id);
      $recently_visited_items = Radio::whereIn('id', $recently_visited_id)
                                       ->orderByRaw(DB::raw("FIELD(id, $tempStr)"))
                                       ->limit(12)->get();
      return $this->sendResponse(['recently_visited_items'=> RadioResource::collection($recently_visited_items) , 'popular_station' => RadioResource::collection($popular_station),'local_radio' => RadioResource::collection($local_radio)], 'Data retrieved successfully.');
      }else{
        $recently_visited_items = null;
        return $this->sendResponse(['recently_visited_items' => null ,'popular_station' => RadioResource::collection($popular_station),'local_radio' => RadioResource::collection($local_radio)], 'Data retrieved successfully.');
      }
    }

    //this will be used as local radio 
    public function radioslocal(){
      //popular station in your area 
      $helper = new Helper();
      $country_model = $helper->get_client_country_model();      
      //local radio 
      $local_radio = $country_model->radios()->orderByDesc('visit_count')->paginate(12);
      return $this->sendResponse(RadioResource::collection($local_radio) , 'Data retrieved successfully.');
    }

    //this is the view showing recent visted radios 
    public function recent(Request $request){
      //Recently visited station
      if(session()->get('recently_viewed')){

      $recently_visited_id = array_reverse(session()->get('recently_viewed'));
      $recently_visited_id = array_unique($recently_visited_id);
      $tempStr = implode(',', $recently_visited_id);
      $recently_visited_items = Radio::whereIn('id', $recently_visited_id)
                                     ->orderByRaw(DB::raw("FIELD(id, $tempStr)"))
                                     ->limit(12)->get();

      }else{
        $recently_visited_items = null;
      }
      return view('front.pages.recent',compact('meta_tag','recently_visited_items'));
    }

    //this is the view showing trending radios sorted by favorite count 
    public function trending(Request $request){
      $trendings = Radio::has('favorites')->with('favorites')->get()->sortByDesc(function($radio)
      {
        return $radio->favorites->count();
      });
      
      return $this->sendResponse(RadioResource::collection($trendings), 'data retrieved successfully.');
    }

    public function radioscategory(Request $request,$category){ 
      $helper = new Helper();
      
      $main_category = Category::where('name',$category)->first();
      
      $func = new Getchild();
      $grant_child_ids = $func->get_child($main_category);

      $parent_id = $main_category->id;
      $sub_categories = category::where('parent_id',$parent_id)->get();
      if (count($sub_categories)) {
        //get the radios with the above country
        $local_stations = $helper->get_client_country_model()->radios()->whereIn('category_id',$grant_child_ids)->paginate(12);

        //get the radios with the above country and orderby visit_count
        $top_stations = $helper->get_client_country_model()
                               ->radios()
                               ->whereIn('category_id',$grant_child_ids)
                               ->orderByDesc('visit_count')
                               ->paginate(12);
         return $this->sendResponse(['local_stations'=> RadioResource::collection($local_stations) , 'top_stations' => RadioResource::collection($top_stations),'sub_categories' => CategoryResource::collection($sub_categories),'main_category' => new CategoryResource($main_category)], 'Data retrieved successfully.');
      }
      else{
       //get the radios with the above country
       $local_stations = $helper->get_client_country_model()->radios()->where('category_id',$parent_id)->paginate(12);
       
       //get the stations with this category
       $stations = Radio::where('category_id',$parent_id)->paginate(12);

       //return to a page if sub_categories of this category is empty
       return $this->sendResponse(['local_stations'=> RadioResource::collection($local_stations) , 'stations' => RadioResource::collection($stations),'main_category' => new CategoryResource($main_category)], 'Data retrieved successfully.');
      }
 }

 
 //this is the view showing list of continents
 public function radiosregion(Request $request){
   $continents = Continent::wherestatus('1')->get();
   //popular station in your area 
   $helper = new Helper();
   $country_model = $helper->get_client_country_model();
   $popular_station = $country_model->radios()->orderByDesc('visit_count')->get();
   //popular station end
   
   //local radio 
   $local_radio = $country_model->radios()->orderByDesc('visit_count')->paginate(12);
   
   return $this->sendResponse(['continents' => ContinentResource::collection($continents),'popular_station' => RadioResource::collection($popular_station),'local_radio' => RadioResource::collection($local_radio)] , 'Data retrieved successfully.');   
  }
  //this is the view showing list of continents
  
  //this is the view showing list of countries
  public function continentview(Request $request,$continent){
    $continent_collection = Continent::where('contient_name',$continent)->firstOrFail();
    $countries = $continent_collection->countries()->get();
    
    $local_radio = Radio::where('continent_id',$continent_collection->id)
    ->orderByDesc('visit_count')->paginate(12);
    
    return $this->sendResponse(['countries' => CountryResource::collection($countries),'local_radio' => RadioResource::collection($local_radio)] , 'Data retrieved successfully.'); 
  }
  //this is the view showing list of countries
  
  //this is the view showing list of states
  public function countryview(Request $request,$country){
    $country_collection = Country::where('name',$country)->firstOrFail();
    $states = $country_collection->states()->get(); 
    
    //local radio 
    $local_radio = Radio::where('country_id',$country_collection->id)->orderByDesc('visit_count')->paginate(12);
    return $this->sendResponse(['country' => new CountryResource($country),
                                'states' => StateResource::collection($states),
                                'local_radio' => RadioResource::collection($local_radio)] ,'Data retrieved successfully.'); 
  }
  //this is the view showing list of states
  
  //this is the view showing list of states
  public function stateview(Request $request,$state){
    $state_collection = State::where('name',$state)->firstOrFail();
    $cities = $state_collection->cities()->get();
    
    //local radio 
    $local_radio = Radio::where('state_id',$state_collection->id)
    ->orderByDesc('visit_count')->paginate(12);
    
    return $this->SendResponse(['state' => $state , 'local_radio' => RadioResource::collection($local_radio),'cities' => CityResource::collection($cities)],'Data retrived successfully');
  }
  //this is the view showing list of states
  
  public function cityview(Request $request,$city){
    $city_collection = City::where('name',$city)->firstOrFail();
    //local radio 
    $local_radio = Radio::where('city_id',$city_collection->id)
    ->orderByDesc('visit_count')->paginate(12);
    return $this->SendResponse(['city' => $city , 'local_radio' => RadioResource::collection($local_radio)],'Data retrived successfully');
  }
  //this is the view showing list of states
  
  //this is the view showing list of languages
  public function language(Request $request){
    $languages = Language::wherestatus('1')->get();      
    return $this->SendResponse(['languages' => LanguageResource::collection($languages)],'Data retrived successfully');    
  }
  //this is the view showing list of languages
  
  //this is the view showing list of countries
  public function languageview(Request $request,$language){
    $language_collection = Language::where('name',$language)->firstOrFail();
    $func = new Getchild();
    $parent_categories = Category::where('parent_id',0)->get();
    $final_category = array();
    foreach ($parent_categories as $parent_category){
      $grant_child_ids = $func->get_child($parent_category);
      $radio = Radio::whereIn('category_id',$grant_child_ids)
      ->where('language_id',$language_collection->id)
      ->get();
      if(count($radio)) {
        array_push($final_category,$parent_category);
      } else {
        //keep silent and watch
      }
      
    }
    
    //popular station in your area 
    $helper = new Helper();
    $country_model = $helper->get_client_country_model();
    $popular_station = $country_model->radios()->orderByDesc('visit_count')->get();
    //popular station end
    
    //local radio 
    $local_radio = $country_model->radios()->orderByDesc('visit_count')->get();
    
    return $this->sendResponse(['language' => $language , 'final_category' => CategoryResource::collection($final_category),'popular_station' => RadioResource::collection($popular_station),'local_radio'=>RadioResource::collection($local_radio)],'data retrived successfully');
  }
  
  //this is the view showing list of countries
  public function langcatview(Request $request,$language,$category){
    $language_collection = Language::where('name',$language)->firstOrFail();
    
    $func = new Getchild();
    
    //popular station in your area 
    $helper = new Helper();
    $country_model = $helper->get_client_country_model();
    
    $parent_categories = Category::where('name',$category)->firstOrFail();
    
    $final_category = array();
    $final_local_radio = array();
    foreach ($parent_categories->childs()->get() as $parent_category){
      if(count($parent_category->childs)){
        $grant_child_ids = $func->get_child($parent_category);
        $radio = Radio::whereIn('category_id',$grant_child_ids)
        ->where('language_id',$language_collection->id)
        ->get();
        $local_radio = $country_model->radios()
        ->whereIn('category_id',$grant_child_ids)
        ->where('language_id',$language_collection->id)
        ->orderByDesc('visit_count')->get();
        
        if(count($local_radio)){
          array_push($final_local_radio,$local_radio);  
        }
        if(count($radio)) {
          array_push($final_category,$parent_category);
        }  
      }
      else{
        $radio = Radio::where('category_id',$parent_category->id)
        ->where('language_id',$language_collection->id)
        ->get();
        
        $local_radio = $country_model->radios()
        ->where('category_id',$parent_category->id)
        ->where('language_id',$language_collection->id)
        ->orderByDesc('visit_count')->get();
        if(count($local_radio)){           
          array_push($final_local_radio,$local_radio);
        }
        if(count($radio)) {
          array_push($final_category,$parent_category);
        } else {
          //keep silent and watch
        } 
      }  
    }
    $final_local_radio = Arr::flatten($final_local_radio);
    
    if(count($parent_categories->childs))
    {
      return $this->sendResponse(['category' => $category , 'language' => $language , 'final_category' => CategoryResource::collection($final_category),'final_local_radio' => RadioResource::collection($final_local_radio)],'data retrived successfuly');
    }
    else{
      $local_radio_childless = $country_model->radios()
      ->where('category_id',$parent_categories->id)
      ->where('language_id',$language_collection->id)
      ->orderByDesc('visit_count')->get();
      return $this->sendResponse(['category' => $category , 'language' => $language ,'local_radio_childless' => RadioResource::collection($local_radio_childless)],'data retrived successfuly');
    }
  }
  
  //this is the view showing showing my favorites
  public function myfavorite(Request $request){
 
    $routeName = Route::currentRouteName();
    $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();
    
    //getting my favorites radios ids in array
    $favorites = Favorite::where('user_id',Auth::user()->id)->pluck('radio_id')->toArray();
    
    //getting radios with these ids array
    $favorites = Radio::whereIn('id',$favorites)->paginate(12);
  
    return view('front.pages.favorites',compact('meta_tag','favorites'));
  }

  //this is the view showing single radio
  public function radioview(Request $request,$slug){

    //popular station in your area 
    $helper = new Helper();
    $country_model = $helper->get_client_country_model();
      $popular_station = $country_model->radios()->orderByDesc('visit_count')->get();
      //popular station end
      
      //local radio 
      $local_radio = $country_model->radios()->orderByDesc('visit_count')->paginate(12); 
    
      $radio = Radio::where('slug',$slug)->firstOrFail();

      session()->push('recently_viewed',$radio->id);
                         
      if (Auth::check()) {
          $favorite = Favorite::where('user_id','=',Auth::user()->id)
                              ->where('radio_id','=',$radio->id)
                              ->first();
      } else {
        $favorite = null;
      };
      return $this->sendResponse(['radio' => new RadioResource($radio),'local_radio' => $local_radio ? RadioResource::collection($local_radio) : 'null','favorite' => $favorite ? RadioResource::collection($favorite) : null], 'datas retrieved successfully.');    
    }
    //this is the view showing list of languages

    private function addToHistory($item) 
    {
        $history = session()->pull('history',[]);
        array_push($history,$item);
        session()->put('history', array_slice($history, -5));
    }

    public function homepage(){
      $testimonial = Testimonial::latest()->take('3')->get();
      $radios = Radio::all()->random(12);
      return $this->sendResponse(['testimonial' => TestimonialResource::collection($testimonial),'radio' => RadioResource::collection($radios)], 'datas retrieved successfully.');
    }

    

      public function advancesearch(Request $request)
      {
          $pagination = 6;
          $filters = 'price';
          $filter = 'bed';
          $country_id = 'country_id';
          $state_id ='state_id';
          $city_id = 'city_id';
          $property_type = 'property_type';
          $sale_type = 'sale_type';
          $countries = Country::wherestatus("Accept")->get();
          if ($request->search != null) {
            $proper=Property::with('user')
            ->join('photos', function ($join) {
                $join->on('properties.id', '=', 'photos.property_id')
                      ->where('photos.banner', '=', 1);
            })
            ->select('properties.*','photos.image')
            ->where('name','like',"%$request->search%")
            ->orWhere('property_type','like',"%$request->search%")
            ->orWhere('sale_type','like',"%$request->search%")
            ->orWhere('price','like',"%$request->search%")
            ->orWhere('beds','like',"%$request->search%")
            ->orWhere('area','like',"%$request->search%");

            if ($request->search != null) {
               $property = $proper->where('address','like',"%$request->search%");
            } else {
              $property = $proper;
            }

          }else {
            $proper=Property::with('user')
                       ->with('country')
                       ->with('state')
                       ->with('city')
                       ->join('photos', function ($join) {
                           $join->on('properties.id', '=', 'photos.property_id')
                                 ->where('photos.banner', '=', 1);
                       })
                       ->select('properties.*','photos.image')
                       ->where(function($query) use ($request,$country_id)
                         {
                                 if ( ! is_null($request->country_id)) $query->where($country_id,'=',$request->country_id);
                         })
                       ->where(function($query) use ($request,$state_id)
                         {
                                 if ( ! is_null($request->state_id)) $query->where($state_id,'=',$request->state_id);
                         })
                        ->where(function($query) use ($request,$city_id)
                          {
                                  if ( ! is_null($request->city_id)) $query->where($city_id,'=',$request->city_id);
                          })
                       ->where(function($query) use ($request, $filters)
                         {
                                 if ( ! is_null($request->minprice)) $query->where($filters,'>',$request->minprice);
                         })
                        ->where(function($query) use ($request, $filters)
                          {
                                  if ( ! is_null($request->maxprice)) $query->where($filters,'<',$request->maxprice);
                          })
                        ->where(function($query) use ($request, $filter)
                          {
                                  if ( ! is_null($request->minbed)) $query->where('beds','>',$request->minbed);
                          })
                        ->where(function($query) use ($request, $filter)
                          {
                                  if ( ! is_null($request->maxbed)) $query->where('beds','<',$request->maxbed);
                          })
                        ->where(function($query) use ($request, $property_type)
                          {
                                  if ( ! is_null($request->property_type)) $query->where($property_type,'=',"$request->property_type");
                          })
                        ->where(function($query) use ($request, $sale_type)
                          {
                                  if ( ! is_null($request->sale_type)) $query->where($sale_type,'=',"$request->sale_type");
                          });

                          if ($request->search1 != null) {
                             $property = $proper->where('address','like',"%$request->search1%");
                          } else {
                            $property = $proper;
                          }
          }



                        if (request()->sort == 'low_high') {
                            $pro = $property->orderBy('price')->paginate($pagination);
                        } elseif (request()->sort == 'high_low') {
                            $pro = $property->orderBy('price', 'desc')->paginate($pagination);
                        } else {
                            $pro = $property->paginate($pagination);
                        }
              return view('front.pages.results',compact('pro','request','countries'));
      }

    public function contact(Request $request){
      return view('fronts.pages.contact',compact('meta_tag'));
    }

    public function store(Request $request)
    {
             $contact = new Contact();
             $contact->name = $request->name;
             $contact->email = $request->email;
             $contact->subject = $request->subject;
             $contact->message = $request->message;
             $contact->save();

             return $this->sendResponse(new ContactResource($contact), 'You message recorded successfully.');
    }
    
    public function report(Request $request)
    {
      $report = Report::create($request->all());
      return response()->json();
    }

    public function favorite(Request $request)
    {
      $input['radio_id'] = $request->id;
      $input['user_id'] = Auth::user()->id;
      $favorite = Favorite::create($input);
      return response()->json();
    }

    public function deletefavorite($id)
    {
      $favorite = Favorite::where('radio_id', $id)
                          ->where('user_id', Auth::user()->id)
                          ->firstorFail();
      $favorite->delete();
      return response()->json();
    }

    public function blog(){
      $posts = Post::with('user')->paginate("3");
      return $this->sendResponse(PostResource::collection($posts), 'Data retrived successfully.');
    }

    public function showblog($slug){
      $post = Post::whereSlug($slug)->first();
      $related = Post::where('category_id',$post->category_id)->limit(3)->get();
      return $this->sendResponse(['post' => new PostResource($post) , 'related' => PostResource::collection($related)], 'Data retrived successfully.');
    }

    public function about(){
      return $this->sendResponse(new AboutResource($about), 'Data retrived successfully.');
    }

    public function showabout($slug){
      $about = About::whereslug($slug)->firstOrFail();
      return $this->sendResponse(new AboutResource($about), 'Data retrived successfully.');
    }

    public function faq(){
      $faqs = Faq::wherestatus('1')->latest()->get();
      return $this->sendResponse(FaqResource::collection($faqs), 'Data retrived successfully.');
    }

}
