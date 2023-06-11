<?php

namespace App\Http\Controllers;

use Goutte\Client;
use File;
use App\Post;
use App\Category;
use DB;
use Auth;

class ScraperController extends Controller
{
    function file_get_contents_curl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    public function index()
    {
        ini_set('max_execution_time', '-1');
        //B::table('categories')->truncate();
        //DB::table('posts')->truncate();

        $blog_urls = [];

        for ($i=0; $i < 5; $i++) { 
            array_push($blog_urls,"https://www.itsolutionstuff.com/category/react-jsexample.html?page=".$i);    
        }

        $blogs_urls_fck = [];
        
        foreach ($blog_urls as $key => $blog_url) {
            // dd($blog_url);
            $client = new Client();
            $blog_get = $client->request('GET',$blog_url);
            $blogs_urls_fck = $blog_get->filter('.read-more')->each(function ($node) {
                return $node->attr('href');
            });

            foreach ($blogs_urls_fck as $key => $blog_url) {
                $client = new Client();
                $blog_get = $client->request('GET',$blog_url);
                $title = $blog_get->filter('h1.fw-bold')->each(function ($node) {
                    return $node->text();
                });
    
                $category = $blog_get->filter('span.category')->each(function ($node) {
                    return $node->text();
                });
    
                $description = $blog_get->filter('.post-description .discription')->each(function ($node) {
                    return $node->html();
                });
    
                    foreach($category as $i=>$cat){
                        $new_category = Category::where('name',$category[$i])->first();
                        if($new_category){
                        }else{
                            $new_category =  Category::create(
                            [                        
                            'name' => $category[$i],
                            'status' => 1,
                            'parent_id' => 0
                            ]);
                        }
        
                        if($title){
                            $desc = str_replace(
                            [
                            "'undefined'",
                            "__ez_fad_position('div-gpt-ad-laravelhelper_com-medrectangle-3-0')",
                            "__ez_fad_position('div-gpt-ad-laravelhelper_com-medrectangle-4-0')",
                            "__ez_fad_position('div-gpt-ad-laravelhelper_com-medrectangle-4-0_1')",
                            "__ez_fad_position('div-gpt-ad-laravelhelper_com-medrectangle-4-0_2')",
                            "__ez_fad_position('div-gpt-ad-laravelhelper_com-banner-1-0')"],
                            ["x",
                            "y",
                            "r",
                            "a",
                            "j",
                            "k"
                            ],$description[$i]);

                            $post = Post::create([
                                'category_id' => $new_category->id,
                                'title' => $title[$i],
                                'slug' => str_replace("https://www.itsolutionstuff.com/post/","",$blog_url),
                                'content' => str_replace(["savanihd","itsolutionstuff.com","ItSolutionStuff.com","itsolutionstuff",'<center><div id="v-laravelhelper"></div><script type="text/ez-screx">(function(v,d,o,ai){ai=d.createElement("script");ai.defer=true;ai.async=true;ai.src=v.location.protocol+o;d.head.appendChild(ai);})(window,document,"//a.vdo.ai/core/v-laravelhelper/vdo.ai.js");</script></center>','<span id="ezoic-pub-ad-placeholder-168" class="ezoic-adpicker-ad"></span>','<span id="ezoic-pub-ad-placeholder-157" class="ezoic-adpicker-ad"></span><span class="ezoic-ad medrectangle-3 medrectangle-3157 adtester-container adtester-container-157" data-ez-name="laravelhelper_com-medrectangle-3"><span id="div-gpt-ad-laravelhelper_com-medrectangle-3-0" ezaw="728" ezah="90" style="position:relative;z-index:0;display:inline-block;padding:0;min-height:90px;min-width:728px" class="ezoic-ad">
                                <script data-ezscrex="false" data-cfasync="false" style="display:none">
                                    if (typeof __ez_fad_position != x) {
                                        y
                                    };
                                </script>
                            </span></span>','<span id="ezoic-pub-ad-placeholder-155" class="ezoic-adpicker-ad"></span><span class="ezoic-ad medrectangle-4 medrectangle-4155 adtester-container adtester-container-155 ezoic-ad-adaptive" data-ez-name="laravelhelper_com-medrectangle-4"><span class="ezoic-ad medrectangle-4 medrectangle-4-multi-155 adtester-container adtester-container-155" data-ez-name="laravelhelper_com-medrectangle-4"><span id="div-gpt-ad-laravelhelper_com-medrectangle-4-0" ezaw="323" ezah="250" style="position:relative;z-index:0;display:inline-block;padding:0;min-height:250px;min-width:323px" class="ezoic-ad">
                            <script data-ezscrex="false" data-cfasync="false" style="display:none">
                                if (typeof __ez_fad_position != x) {
                                    r
                                };
                            </script>
                        </span></span><span class="ezoic-ad medrectangle-4 medrectangle-4-multi-155 adtester-container adtester-container-155" data-ez-name="laravelhelper_com-medrectangle-4"><span id="div-gpt-ad-laravelhelper_com-medrectangle-4-0_1" ezaw="323" ezah="250" style="position:relative;z-index:0;display:inline-block;padding:0;min-height:250px;min-width:323px" class="ezoic-ad">
                            <script data-ezscrex="false" data-cfasync="false" style="display:none">
                                if (typeof __ez_fad_position != x) {
                                    a
                                };
                            </script>
                        </span></span><span class="ezoic-ad medrectangle-4 medrectangle-4-multi-155 adtester-container adtester-container-155" data-ez-name="laravelhelper_com-medrectangle-4"><span id="div-gpt-ad-laravelhelper_com-medrectangle-4-0_2" ezaw="323" ezah="250" style="position:relative;z-index:0;display:inline-block;padding:0;min-height:250px;min-width:323px" class="ezoic-ad">
                            <script data-ezscrex="false" data-cfasync="false" style="display:none">
                                if (typeof __ez_fad_position != x) {
                                    j
                                };
                            </script>
                        </span></span>
                    <style>
                        .medrectangle-4-multi-155 {
                            border: none !important;
                            display: block !important;
                            float: none;
                            line-height: 0;
                            margin-bottom: 15px !important;
                            margin-left: 0 !important;
                            margin-right: 0 !important;
                            margin-top: 15px !important;
                            min-height: 250px;
                            min-width: 300px;
                            padding: 0;
                            text-align: center !important
                        }
                    </style>
                </span>','<span id="ezoic-pub-ad-placeholder-156" class="ezoic-adpicker-ad"></span><span class="ezoic-ad banner-1 banner-1156 adtester-container adtester-container-156" data-ez-name="laravelhelper_com-banner-1"><span id="div-gpt-ad-laravelhelper_com-banner-1-0" ezaw="300" ezah="250" style="position:relative;z-index:0;display:inline-block;padding:0;min-height:250px;min-width:300px" class="ezoic-ad">
                <script data-ezscrex="false" data-cfasync="false" style="display:none">
                    if (typeof __ez_fad_position != x) {
                        k
                    };
                </script>
            </span></span>'],["suntharansnr","laravelhelper.xyz","laravelhelper.xyz","laravelhelper","","","","",""],$desc),
                                'status' => "Accept",
                                'post_type' => 1,
                                'user_id' => Auth::user()->id
                               ]);
                        }
                    }
    
            }
        }

        return compact('title', 'img_path', 'stream');
    }
}
