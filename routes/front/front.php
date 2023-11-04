<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//front end section routes start
Route::get('/', 'PagesController@homepage')->name('homepage');
Route::group(['middleware'=>'auth'], function () {
Route::get('/view/{id}', 'PagesController@view')->name('property.view');
Route::POST('/comment', 'CommentController@store')->name('comments.store');
Route::delete('comment/{id}', 'CommentController@delete')->name('comment.delete');
Route::get('comment/edit/{id}', 'CommentController@edit')->name('comment.edit');
Route::POST('comment/update', 'CommentController@update')->name('comment.update');
});
Route::get('/blog/{slug}', 'PagesController@showblog')->name('blog.show');

Route::get('/update-views', 'PagesController@updateViews')->name('updateviews');
Route::post('/subscribe', 'PagesController@subscribe')->name('subscribe');
Route::get('/service','PagesController@service')->name('service');

Route::group(['middleware'=>'views'], function () {
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/about/{slug}', 'PagesController@showabout')->name('about.show');
Route::get('/faq', 'PagesController@faq')->name('faq');
});

Route::get('/search', 'PagesController@advancesearch')->name('advancesearch');
Route::POST('/contact', 'PagesController@store')->name('contact.store');
Route::POST('/report', 'PagesController@report')->name('report.store');
Route::get('/blog', 'PagesController@blog')->name('blog');

Route::get('/blog/category/{category_id}', 'PagesController@category')->name('blogs.category');
Route::get('/radios/region', 'PagesController@radiosregion')->name('radio.region');
Route::get('/blogs/recent', 'PagesController@recent')->name('blog.recent');
Route::get('/radios/trending', 'PagesController@trending')->name('radio.trending');
Route::get('/blogs/popular', 'PagesController@popular')->name('blog.popular');

Route::get('/postsearch', 'PagesController@postsearch')->name('post.postsearch');

Route::group(['middleware'=>'auth'],function() {
Route::get('/radios/favorite', 'PagesController@myfavorite')->name('favorites.index');
Route::get('/favorite', 'PagesController@favorite')->name('favorite.store');
Route::DELETE('/favorite/delete/{id}', 'PagesController@deletefavorite')->name('favorite.delete');
});
//front end section routes ends