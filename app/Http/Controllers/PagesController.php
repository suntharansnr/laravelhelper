<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Route;
use App\Metatag;
use App\Favorite;
use Auth;
use App\Post;
use App\Category;
use App\Models\Subscription;
use App\services\helper;
use App\Notifications\NewUserVisit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    //this is the view showing the search view
    public function getsearch(Request $request)
    {

        $routeName = Route::currentRouteName();
        $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();

        //popular station in your area
        $helper = new Helper();
        $country_model = $helper->get_client_country_model();
        $popular_station = $country_model->radios()->orderByDesc('visit_count')->limit(12)->get();
        //popular station end

        return view('front.pages.search', compact('meta_tag', 'popular_station'));
    }

    public function postsearch(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('radios')
                    ->where('name', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->orderBy('visit_count', 'desc')
                    ->get();
                $total_row = $data->count();
                if ($total_row > 0) {
                    foreach ($data as $row) {
                        $output .= '
          <div class="row">
             <div class="col-lg-2 col-md-3">
                <div class="card">
                  <img src=" ' . $row->logo . ' " class="img-fluid">
                  <div class="card-img-overlay d-flex justify-content-center">
                    <button type="button" class="btn btn-default btn-xl btn-circle play-station play align-self-center" id="' . $row->id . '" data-id="' . $row->id . '" data-name="' . $row->name . '" data-url=" ' . $row->stream_url . '"> <i class="fas fa-play"></i> </button>
                  </div>
                </div>
             </div>
             <a href=" ' . route('radio.view', $row->name) . '">
             <div class="col-lg-10 col-md-9  my-auto pt-3">
                       <h5 style="color:#261630;font-weight:600" >' . $row->name . '</h5>
                       <p style="color:#261630"> ' . (Str::limit($row->description, 100)) . '</p>
             </div>
             </a>
          </div>
          <hr>
          ';
                    }
                } else {
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
            } else {
                $data = '';
            }

            echo json_encode($data);
        }
    }

    //this is the view showing recent visted radios
    public function recent(Request $request)
    {

        $routeName = Route::currentRouteName();
        $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();

        //Recently visited station
        if (session()->get('recently_viewed')) {

            $recently_visited_id = array_reverse(session()->get('recently_viewed'));
            $recently_visited_id = array_unique($recently_visited_id);
            $tempStr = implode(',', $recently_visited_id);
            $recently_visited_items = Radio::whereIn('id', $recently_visited_id)
                ->orderByRaw(DB::raw("FIELD(id, $tempStr)"))
                ->limit(12)->get();
        } else {
            $recently_visited_items = null;
        }
        return view('front.pages.recent', compact('meta_tag', 'recently_visited_items'));
    }

    //this is the view showing trending radios sorted by favorite count
    public function trending(Request $request)
    {

        $routeName = Route::currentRouteName();
        $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();

        $trendings = Radio::has('favorites')->with('favorites')->get()->sortByDesc(function ($radio) {
            return $radio->favorites->count();
        });

        return view('front.pages.trending', compact('meta_tag', 'trendings'));
    }

    //this is the view showing trending radios sorted by favorite count
    public function popular(Request $request)
    {
        $posts = Post::orderBy('views_count','desc')->limit(12)->get();
        return view('fronts.pages.popular', compact('posts'));
    }

    //this is the view showing showing my favorites
    public function myfavorite(Request $request)
    {

        $routeName = Route::currentRouteName();
        $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();

        //getting my favorites radios ids in array
        $favorites = Favorite::where('user_id', Auth::user()->id)->pluck('radio_id')->toArray();

        //getting radios with these ids array
        $favorites = Radio::whereIn('id', $favorites)->paginate(12);

        return view('front.pages.favorites', compact('meta_tag', 'favorites'));
    }

    //this is the view showing single radio
    public function radioview(Request $request, $radio)
    {
        //popular station in your area
        $helper = new Helper();
        $country_model = $helper->get_client_country_model();
        $popular_station = $country_model ? $country_model->radios()->orderByDesc('visit_count')->get() : '';
        //popular station end

        //local radio
        $local_radio = $country_model ? $country_model->radios()->orderByDesc('visit_count')->paginate(12) : '';

        $radio = Radio::where('name', $radio)->firstOrFail();
        $expiresAt = now()->addHours(24);
        views($radio)->cooldown($expiresAt)
            ->record();


        session()->push('recently_viewed', $radio->id);

        if (Auth::check()) {
            $favorite = Favorite::where('user_id', '=', Auth::user()->id)
                ->where('radio_id', '=', $radio->id)
                ->first();
        } else {
            $favorite = null;
        };

        return view('front.pages.radioview', compact('radio', 'local_radio', 'favorite'));
    }
    //this is the view showing list of languages

    private function addToHistory($item)
    {
        $history = session()->pull('history', []);

        array_push($history, $item);

        session()->put('history', array_slice($history, -5));
    }

    public function homepage()
    {
        $routeName = Route::currentRouteName();
        $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();

        $posts = Post::where('status','Accept')
                     ->with('user')->paginate(6);

        return view('fronts.pages.blog', compact('meta_tag', 'posts'));
    }

    public function showblog($slug)
    {
        $routeName = Route::currentRouteName();
        $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();

        $post = Post::whereSlug($slug)
                    ->where('status','Accept')
                    ->firstorfail();
        
        if(Auth::check()){
            if(!Auth::user()->isAdmin()){
            $post->views_count = $post->views_count + 1;
            $post->save();
            }
        }
        else{
            $post->views_count = $post->views_count + 1;
            $post->save();
        }

        $related = Post::where('category_id', $post->category_id)
                       ->where('status','Accept')
                       ->whereNotIn('id',[$post->id])
                       ->limit(3)->get();

        $cat_data = [];
        $categories_ids = Post::where('status','Accept')->groupBy('category_id')->pluck('category_id');
        $categories = Category::wherein('id',$categories_ids)->get();
        foreach($categories as $i => $category){
           $cat_data[$i]['cat_id'] = $category->id;
           $cat_data[$i]['cat_name'] = $category->name;
           $cat_data[$i]['cat_count'] = Post::where('category_id',$category->id)
                                            ->where('status','Accept')
                                            ->count();
        }
        $noty_users = \App\Models\User::role('admin')->get();
          foreach ($noty_users as $notifiable_id) {
              $notifiable_id->notify(new NewUserVisit($post));
          }
        return view('fronts.pages.showblog', compact('meta_tag', 'post', 'related','cat_data'));
    }

    public function category($category_id){
        $posts = Post::where('category_id',$category_id)
                    ->where('status','Accept')
                    ->paginate(6);
        return view('fronts.pages.category',compact('posts'));
    }

    public function updateViews(){
        $posts = Post::all();
        foreach($posts as $post){
            $post->views_count = views($post)->count();
            $post->save();
        }
        echo "done";
    }

    public function subscribe(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscriptions,email',
          ]);
          if($validator->passes()){
              Subscription::create($request->all());
          }
          else{
              return response()->json(['error'=>$validator->errors()->all()]);
          }
    }
}
