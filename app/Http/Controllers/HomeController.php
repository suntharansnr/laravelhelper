<?php

namespace App\Http\Controllers;
use App\Post;
use Auth;
use App\Models\User;
use Route;
use App\Metatag;
use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Arr;


class HomeController extends Controller
{
        function __construct()
        {
             $this->middleware('permission:home-list|', ['only' => ['index']]);
        }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Analytics::fetchMostVisitedPages(Period::days(7));
        $url = $pages->pluck('url');
        $pageTitle = $pages->pluck('pageTitle');
        $pageViews = $pages->pluck('pageViews');
        //retrieve visitors and pageview data for the current day and the last fifteen days
        $visitors = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        // Retrieve Total Visitors and Page Views
        $total_visitors = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        $dates = $total_visitors->pluck('date');
        $visitors = $total_visitors->pluck('visitors');
        $pageViews = $total_visitors->pluck('pageViews');
//        dd($total_visitors);
        // Retrieve Top Referrers
        $top_referrers = Analytics::fetchTopReferrers(Period::days(7));

//        dd($top_referrers);
        // Retrieve User Types
        $user_types = Analytics::fetchUserTypes(Period::days(7));
        $type = $user_types->pluck('type');
        $sessions1 = $user_types->pluck('sessions');
        //Retrieve Top Browsers
        $top_browser = Analytics::fetchTopBrowsers(Period::days(7));
        $browser = $top_browser->pluck('browser');
        $sessions = $top_browser->pluck('sessions');
        //retrieve sessions and pageviews with yearMonth dimension since 1 year ago
        $analyticsData = Analytics::performQuery(
           Period::years(1),
              'ga:sessions',
              [
                  'metrics' => 'ga:sessions, ga:pageviews',
                  'dimensions' => 'ga:yearMonth'
              ]
        );

        $re = Analytics::topCountries()->toArray();
        $result = Arr::prepend($re,['Country', 'Views']);

        if (Auth::user()->isStation_owner()) {
          $prop = Post::where('user_id','=',Auth::User()->id);
          $countprop=$prop->count();
          $pro = Post::where('user_id','=',Auth::User()->id)
                         ->where('status','=','Draft');
          $countpro = $pro->count();

          $pror = Post::where('user_id','=',Auth::User()->id)
                         ->where('status','=','Request_to_publish');
          $countrequest = $pror->count();

          $prod = Post::where('user_id','=',Auth::User()->id)
                         ->where('status','=','Deny');
          $countdeny = $prod->count();

          $proa = Post::where('user_id','=',Auth::User()->id)
                         ->where('status','=','Accept');
          $countproa = $proa->count();

          $users = User::all();
          $usercount = $users->count();

          $activeusers = User::where('user_status','=','1');
          $actusercount = $activeusers->count();

          $suspendusers = User::where('user_status','=','0');
          $suspenduserscount = $suspendusers->count();
        }
        else {
          $prop = Post::all();
          $countprop=$prop->count();
          $pro = Post::where('status','=','Draft');
          $countpro = $pro->count();

          $pror = Post::where('status','=','Request_to_publish');
          $countrequest = $pror->count();

          $prod = Post::where('status','=','Deny');
          $countdeny = $prod->count();

          $proa = Post::where('status','=','Accept');
          $countproa = $proa->count();

          $users = User::all();
          $usercount = $users->count();

          $activeusers = User::where('user_status','=','1');
          $actusercount = $activeusers->count();

          $suspendusers = User::where('user_status','=','0');
          $suspenduserscount = $suspendusers->count();
        }
        if(Auth::user()->isUser()){
                return view('admin.home',compact('pageTitle','pageViews','url','pages','pageViews','type','sessions1','browser','sessions','dates','visitors','top_browser','prop','countprop','pro','countpro','pror','actusercount','suspenduserscount','countrequest','prod','countdeny','proa','countproa','usercount','result'));
        }
        else{
                return view('admin.home',compact('pageTitle','pageViews','url','pages','pageViews','type','sessions1','browser','sessions','dates','visitors','top_browser','prop','countprop','pro','countpro','pror','actusercount','suspenduserscount','countrequest','prod','countdeny','proa','countproa','usercount','result'));
        }
    }
}
