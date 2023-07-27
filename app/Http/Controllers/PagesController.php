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
use App\Contact;
use App\Models\Subscription;
use App\services\helper;
use App\Notifications\NewUserVisit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function postsearch(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('q');
            if ($query != '') {
                $data = DB::table('posts')
                    ->where('title', 'like', '%' . $query . '%')
                    ->orWhere('content', 'like', '%' . $query . '%')
                    ->orderBy('views_count', 'desc')
                    ->limit(5)
                    ->get();
                return response()->json($data);
            }
            else{
                return response()->json();
            }
        }
    }

    //this is the view showing recent visted radios
    public function recent(Request $request)
    {
        $routeName = Route::currentRouteName();
        $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();
        //Recently visited posts by user
        if (session()->get('recently_viewed')) {
            $recently_visited_id = array_reverse(session()->get('recently_viewed'));
            $recently_visited_id = array_unique($recently_visited_id);
            $tempStr = implode(',', $recently_visited_id);
            $posts = Post::whereIn('id', $recently_visited_id)
                ->orderByRaw(DB::raw("FIELD(id, $tempStr)"))
                ->limit(12)->get();
        } else {
            $posts = null;
        }
        return view('fronts.pages.popular', compact('meta_tag', 'posts'));
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
        $posts = Post::orderBy('views_count', 'desc')->limit(12)->get();
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

    public function homepage()
    {
        $routeName = Route::currentRouteName();
        $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();

        $posts = Post::where('status', 'Accept')
            ->with('user')->paginate(6);

        return view('fronts.pages.blog', compact('meta_tag', 'posts'));
    }

    public function showblog($slug)
    {
        $routeName = Route::currentRouteName();
        $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();

        $post = Post::whereSlug($slug)
            ->where('status', 'Accept')
            ->firstorfail();

        session()->push('recently_viewed', $post->id);

        if (Auth::check()) {
            if (!Auth::user()->isAdmin()) {
                $post->views_count = $post->views_count + 1;
                $post->save();
            }
        } else {
            $post->views_count = $post->views_count + 1;
            $post->save();
        }

        $related = Post::where('category_id', $post->category_id)
            ->where('status', 'Accept')
            ->whereNotIn('id', [$post->id])
            ->limit(3)->get();

        $cat_data = [];
        $categories_ids = Post::where('status', 'Accept')->groupBy('category_id')->pluck('category_id');
        $categories = Category::wherein('id', $categories_ids)->get();
        foreach ($categories as $i => $category) {
            $cat_data[$i]['cat_id'] = $category->id;
            $cat_data[$i]['cat_name'] = $category->name;
            $cat_data[$i]['cat_count'] = Post::where('category_id', $category->id)
                ->where('status', 'Accept')
                ->count();
        }
        $noty_users = \App\Models\User::role('admin')->get();
        foreach ($noty_users as $notifiable_id) {
            $notifiable_id->notify(new NewUserVisit($post));
        }
        return view('fronts.pages.showblog', compact('meta_tag', 'post', 'related', 'cat_data'));
    }

    public function category($category_id)
    {
        $posts = Post::where('category_id', $category_id)
            ->where('status', 'Accept')
            ->paginate(6);
        return view('fronts.pages.category', compact('posts'));
    }

    public function updateViews()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->views_count = views($post)->count();
            $post->save();
        }
        echo "done";
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscriptions,email',
        ]);
        if ($validator->passes()) {
            Subscription::create($request->all());
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function contact(Request $request)
    {
        $routeName = Route::currentRouteName();
        $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();
        return view('fronts.pages.contact', compact('meta_tag'));
    }
    public function store(Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        return response()->json([
            'message' => 'success',
            'fail' => false,
            'redirect_url' => url('contact')
        ]);
    }

    public function about()
    {
        return redirect("https://rajvarman.laravelhelper.monster");
        // $routeName = Route::currentRouteName();
        // $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();
        // return view('fronts.pages.aboutus', compact('meta_tag'));
    }
    public function showabout($slug)
    {
        $about = About::whereslug($slug)->firstOrFail();
        return view('fronts.pages.showabout', compact('meta_tag', 'about'));
    }

    public function faq()
    {
        $routeName = Route::currentRouteName();
        $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();

        $faqs = Faq::wherestatus('1')->latest()->get();
        $faq_chunk = ($faqs->count() / 2);
        return view('fronts.pages.faq', compact('meta_tag', 'faqs', 'faq_chunk'));
    }
}
