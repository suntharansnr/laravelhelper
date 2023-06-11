<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Models\User;

class SitemapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->first();
        $categories = Category::all()->first();
        return response()->view('sitemap.index', [
            'posts' => $posts,
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }

    public function posts()
    {
        $posts = Post::where('status','Accept')
                     ->latest()
                     ->get();
        return response()->view('sitemap.posts', [
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }



    public function categories()
    {
        $categories = Category::all();
        return response()->view('sitemap.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }

    public function site_url()
    {
        $user = User::latest()->first();
        return response()->view('sitemap.site_url', [
            'user' => $user,
        ])->header('Content-Type', 'text/xml');
    }
}
