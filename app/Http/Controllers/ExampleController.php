<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExampleController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')
            ->join('categories', 'posts.category_id','=','categories.id')
            ->where('categories.id', '=','2')
            ->get();

        $posts_grouped = DB::table('posts')
        ->select('categories.name as category_name','users.name as user_name','posts.title as post_title','posts.created_at as created_at')
        ->join('categories', 'posts.category_id','=','categories.id')
        ->join('users', 'posts.user_id','=','users.id')
        ->get();

        foreach($posts_grouped as $post) {
            $category_name = $post->category_name;
            $created_at = $post->created_at->format('Y-m-d');
            if (!isset($finale_data['categories_wise_count'][$category_name][$created_at])) {
                $finale_data['categories_wise_count'][$category_name][$created_at] = 0; // Initialize the count to 0 for each category
            }
            $finale_data['categories_wise_count'][$category_name][$created_at]++; // Increment the count for the current category
        }

        dd($finale_data['categories_wise_count']);

        return view('fronts.pages.example',compact('posts_grouped','posts','finale_data'));
    }
}
