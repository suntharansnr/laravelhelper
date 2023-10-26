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

/*
Route::get('/', function () {
    return view('welcome');
})->middleware('admin');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
*/

//spatie laravel role based management
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
});
//spatie laravel role based management

//social media register routes start
Route::get('login/{provider}', 'SocialauthController@redirect');
Route::get('login/{provider}/callback','SocialauthController@Callback');
//Social media register routes ends

Route::group(['middleware'=>'auth'], function () {
  Route::get('/dashboard', 'HomeController@index')->name('dashboard');
  Route::resource('tag', 'TagController');
  Route::get('/notifications', 'UsersController@notifications');
  Route::get('admin/notifications', 'UsersController@AdminNotifications')->name('admin.notifications');
  Route::get('admin/contact','ContactController@index')->name('contact.index');
  Route::get('admin/contact/{id}','ContactController@show')->name('contact.show');
  Route::DELETE('admin/contact/{id}','ContactController@destroy')->name('contact.destroy');

  Route::get('admin/scrape','ScraperController@index')->name('scrape');

  Route::get('admin/report','ReportController@index')->name('report.index');
  Route::get('admin/report/{id}','ReportController@show')->name('report.show');
  Route::DELETE('admin/report/{id}','ReportController@destroy')->name('report.destroy');

  Route::get('theme','ThemeController@index')->name('theme.index');
  Route::get('theme/edit/{id}','ThemeController@edit')->name('theme.edit');
  Route::POST('admin/theme','ThemeController@store')->name('theme.store');

  Route::get('social-urls','SocialController@index')->name('social-urls.index');
  Route::get('social-urls/{id}/edit','SocialController@edit')->name('social-urls.edit');
  Route::POST('social-urls','SocialController@store')->name('social-urls.store');

  Route::get('meta','MetaController@index')->name('meta.index');
  Route::get('meta/{id}/edit','MetaController@edit')->name('meta.edit');
  Route::POST('meta','MetaController@store')->name('meta.store');
  Route::get('profile','ProfileController@show')->name('profile.show');

  Route::post('updateprofile','ProfileController@updateprofile')->name('profile.updateprofile');
  Route::post('change_password','ProfileController@change_password')->name('profile.change_password');
});

//User management section routes starts
Route::group(['prefix' => 'users','middleware'=>'auth'], function () {
    Route::get('/', 'UsersController@index')->name('users.index');
    Route::match(['get', 'put'], 'edit/{id}', 'UsersController@edit')->name('users.edit');
    Route::get('show/{id}', 'UsersController@show')->name('users.show');
    Route::delete('delete/{id}', 'UsersController@destroy')->name('user.delete');
    Route::post('store', 'UsersController@store')->name('user.store');
    Route::get('Status_Update','UsersController@Status_Update')->name('Status_Update');
});
//User management section routes ends

//Subscriptions section routes starts
Route::group(['prefix' => 'subscriptions','middleware'=>'auth'], function () {
    Route::get('/', 'SubscriptionController@index')->name('subscriptions.index');
    Route::match(['get', 'put'], 'edit/{id}', 'SubscriptionController@edit')->name('subscriptions.edit');
    Route::get('show/{id}', 'SubscriptionController@show')->name('subscriptions.show');
    Route::delete('delete/{id}', 'SubscriptionController@destroy')->name('subscriptions.delete');
    Route::post('store', 'SubscriptionController@store')->name('subscriptions.store');
    Route::get('Status_Update','SubscriptionController@Status_Update')->name('Status_Update');
});
//Subscriptions section routes ends

//post details section routes starts
Route::group(['prefix' => 'post','middleware'=>'auth'], function () {
    Route::get('/', 'PostController@index')->name('post.index');
    Route::post('store', 'PostController@store')->name('post.store');
    Route::get('edit/{id}', 'PostController@edit')->name('post.edit');
    Route::post('update', 'PostController@update')->name('post.update');
    Route::get('show/{id}', 'PostController@show')->name('post.show');
    Route::delete('delete/{id}', 'PostController@delete');

    Route::patch('request/{id}','PostController@Request')->name('Request');
    Route::get('Post_Status_Update','PostController@Status_Update')->name('Post_Status_Update');
    //post details section routes ends
});

//category section routes starts
Route::group(['prefix' => 'category','middleware'=>'auth'], function () {
    Route::get('/', 'CategoryController@index')->name('category.index');
    Route::post('store', 'CategoryController@store')->name('category.store');
    Route::get('edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::post('update', 'CategoryController@update')->name('category.update');
    Route::get('show/{id}', 'CategoryController@show')->name('category.show');
    Route::delete('delete/{id}', 'CategoryController@delete');

    Route::patch('request/{id}','CategoryController@Request')->name('Request');
    Route::get('Status_Update','CategoryController@Status_Update')->name('category.status_update');
    //category section routes ends
});

//front end section routes start
Route::get('/', 'PagesController@homepage')->name('homepage');
Route::group(['middleware'=>'auth'], function () {
Route::get('/view/{id}', 'PagesController@view')->name('property.view');
Route::POST('/comment', 'CommentController@store')->name('comments.store');
Route::delete('comment/{id}', 'CommentController@delete')->name('comment.delete');
Route::get('comment/edit/{id}', 'CommentController@edit')->name('comment.edit');
Route::POST('comment/update', 'CommentController@update')->name('comment.update');
Route::get('/blog/{slug}', 'PagesController@showblog')->name('blog.show');
});

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


//sitemap routes starts
Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('/sitemap.xml/posts', 'SitemapController@posts');
Route::get('/sitemap.xml/categories', 'SitemapController@categories');
Route::get('/sitemap.xml/site_url', 'SitemapController@site_url');
//sitmap routes ends

//optimize clear start
Route::get('/optimize-clear', function() {
    $exitCode = Artisan::call('optimize:clear');
    return 'optimize cleared';
});
//optimize clear end

Route::get('/example', 'ExampleController@index')->name('example.index');