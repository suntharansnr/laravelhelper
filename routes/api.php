<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\PagesController;
use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\StateController;
use App\Http\Controllers\API\CountryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

     

//front end section routes start
Route::middleware('cors')->group( function () {
Route::get('/', [PagesController::class, 'homepage']);
Route::POST('/contact', [PagesController::class, 'store']);
Route::get('/about', [PagesController::class, 'about']);
Route::get('/about/{slug}', [PagesController::class, 'showabout']);
Route::get('/faq', [PagesController::class, 'faq']);
Route::get('/blog', [PagesController::class, 'blog']);
Route::get('/blog/{slug}',[PagesController::class, 'showblog']);
Route::get('/home/radio', [PagesController::class,'radios']);
Route::get('/radio/{category}', [PagesController::class,'radioscategory']);
Route::get('/radios/local', [PagesController::class,'radioslocal']);
Route::get('/radios/region', [PagesController::class,'radiosregion']);
Route::get('/radios/recents', [PagesController::class,'recent']);
Route::get('/radios/trending', [PagesController::class,'trending']);
Route::get('/radios/region/{continent}', [PagesController::class,'continentview']);
Route::get('/radios/country/{country}', [PagesController::class ,'countryview']);
Route::get('/radios/state/{state}', [PagesController::class,'stateview']);
Route::get('/radios/city/{city}', [PagesController::class,'cityview']);
Route::get('/radios/language', [PagesController::class,'language']);
Route::get('/radios/language/{language}', [PagesController::class,'languageview']);
Route::get('/radios/{language}/{category}', [PagesController::class , 'langcatview']);
Route::get('/Radio/{radio}', [PagesController::class , 'radioview']);

Route::get('/getsearch', 'PagesController@getsearch')->name('radio.getsearch');
Route::get('/postsearch', 'PagesController@postsearch')->name('radio.postsearch');

Route::middleware('auth:api')->group( function () {
Route::get('/search', 'PagesController@advancesearch')->name('advancesearch');
Route::POST('/comment', 'CommentController@store')->name('comments.store');
Route::delete('comment/{id}', 'CommentController@delete')->name('comment.delete');
Route::get('comment/edit/{id}', 'CommentController@edit')->name('comment.edit');
Route::POST('comment/update', 'CommentController@update')->name('comment.update');
Route::POST('/report', 'PagesController@report')->name('report.store');

Route::get('/radios/favorite', 'PagesController@myfavorite')->name('favorites.index');
Route::get('/favorite', 'PagesController@favorite')->name('favorite.store');
Route::DELETE('/favorite/delete/{id}', 'PagesController@deletefavorite')->name('favorite.delete');
});
//front end section routes ends


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

  Route::get('admin/contact','ContactController@index')->name('contact.index');
  Route::get('admin/contact/{id}','ContactController@show')->name('contact.show');
  Route::DELETE('admin/contact/{id}','ContactController@destroy')->name('contact.destroy');

  Route::get('admin/report','ReportController@index')->name('report.index');
  Route::get('admin/report/{id}','ReportController@show')->name('report.show');
  Route::DELETE('admin/report/{id}','ReportController@destroy')->name('report.destroy');

  Route::get('theme','ThemeController@index')->name('theme.index');
  Route::get('theme/edit/{id}','ThemeController@edit')->name('theme.edit');
  Route::POST('theme','ThemeController@store')->name('theme.store');

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

//post details section routes starts
Route::group(['prefix' => 'post','middleware'=>'auth'], function () {
    Route::get('/', 'PostController@index')->name('post.index');
    Route::post('store', 'PostController@store')->name('post.store');
    Route::get('edit/{id}', 'PostController@edit')->name('post.edit');
    Route::post('update', 'PostController@update')->name('post.update');
    Route::get('show/{id}', 'PostController@show')->name('post.show');
    Route::delete('delete/{id}', 'PostController@delete');

    //post management section routes
    Route::patch('request/{id}','PostController@Request')->name('Request');
    Route::get('Post_Status_Update','PostController@Status_Update')->name('Post_Status_Update');
    //post details section routes ends
});

//post details section routes starts
Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('store', [CategoryController::class, 'store']);
    Route::get('edit/{id}', [CategoryController::class, 'edit']);
    Route::post('update', [CategoryController::class, 'update']);
    Route::get('show/{id}', [CategoryController::class, 'show']);
    Route::delete('delete/{id}', [CategoryController::class, 'delete']);

    //post management section routes
    Route::patch('request/{id}','CategoryController@Request')->name('Request');
    Route::get('Status_Update','CategoryController@Status_Update')->name('category.status_update');
    //post details section routes ends
});

});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});