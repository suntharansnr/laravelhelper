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
//social media register routes start
Route::get('login/{provider}', 'SocialauthController@redirect');
Route::get('login/{provider}/callback','SocialauthController@Callback');
//Social media register routes ends

Route::group(['middleware'=>'auth'], function () {
  Route::get('/dashboard', 'HomeController@index')->name('dashboard');
  Route::resource('tag', 'TagController');
  Route::get('admin/scrape','ScraperController@index')->name('scrape');
  Route::get('profile','ProfileController@show')->name('profile.show');
  Route::post('updateprofile','ProfileController@updateprofile')->name('profile.updateprofile');
  Route::post('change_password','ProfileController@change_password')->name('profile.change_password');
});

//optimize clear start
Route::get('/optimize-clear', function() {
    $exitCode = Artisan::call('optimize:clear');
    return 'optimize cleared';
});
//optimize clear end

Route::get('/example', 'ExampleController@index')->name('example.index');