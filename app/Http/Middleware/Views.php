<?php

namespace App\Http\Middleware;

use App\Metatag;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Views
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = Route::currentRouteName();
        $meta_tag = Metatag::where('route', '=', $routeName)->firstOrFail();
        $meta_tag->views = $meta_tag->views + 1;
        $meta_tag->save();
        return $next($request);
    }
}
