<?php

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

//radio details section routes starts
Route::group(['prefix' => 'radio','middleware'=>'auth'], function () {
    Route::get('/', 'RadioController@index')->name('radio.index');
    Route::post('store', 'RadioController@store')->name('radio.store');
    Route::get('edit/{id}', 'RadioController@edit')->name('radio.edit');
    Route::post('update', 'RadioController@update')->name('radio.update');
    Route::get('show/{id}', 'RadioController@show')->name('radio.show');
    Route::delete('delete/{id}', 'RadioController@delete');
    Route::get('status','RadioController@Status_Update')->name('radio.change_status');
});

Route::get('radio/countries/{id}','RadioController@getCountries');
Route::get('radio/states/{id}','RadioController@getStates');
Route::get('radio/cities/{id}','RadioController@getCities');
//radio details section routes ends

Route::patch('request/{id}','RadioController@Request')->name('Request');
Route::get('Property_Status_Update','RadioController@Status_Update')->name('Property_Status_Update');
//property details section routes ends

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

//about details section routes starts
Route::group(['prefix' => 'about-us','middleware'=>'auth'], function () {
    Route::get('/', 'AboutController@index')->name('about.index');
    Route::post('store', 'AboutController@store')->name('about.store');
    Route::get('edit/{id}', 'AboutController@edit')->name('about.edit');
    Route::post('update', 'AboutController@update')->name('about.update');
    Route::get('show/{id}', 'AboutController@show')->name('about.show');
    Route::delete('delete/{id}', 'AboutController@delete');
    Route::get('status','AboutController@Status_Update')->name('about.status');
    //about details section routes ends
});

//about details section routes starts
Route::group(['prefix' => 'team','middleware'=>'auth'], function () {
    Route::get('/', 'TeamController@index')->name('team.index');
    Route::post('store', 'TeamController@store')->name('team.store');
    Route::get('edit/{id}', 'TeamController@edit')->name('team.edit');
    Route::post('update', 'TeamController@update')->name('team.update');
    Route::get('show/{id}', 'TeamController@show')->name('team.show');
    Route::delete('delete/{id}', 'TeamController@delete');
    Route::get('status','TeamController@Status_Update')->name('team.status');
    //about details section routes ends
});

//about details section routes starts
Route::group(['prefix' => 'testimonial','middleware'=>'auth'], function () {
    Route::get('/', 'TestimonialController@index')->name('testimonial.index');
    Route::post('store', 'TestimonialController@store')->name('testimonial.store');
    Route::get('edit/{id}', 'TestimonialController@edit')->name('testimonial.edit');
    Route::post('update', 'TestimonialController@update')->name('testimonial.update');
    Route::get('show/{id}', 'TestimonialController@show')->name('testimonial.show');
    Route::delete('delete/{id}', 'TestimonialController@delete');
    Route::get('status','TestimonialController@Status_Update')->name('testimonial.status');
    //about details section routes ends
});

//about details section routes starts
Route::group(['prefix' => 'faqs','middleware'=>'auth'], function () {
    Route::get('/', 'FaqController@index')->name('faq.index');
    Route::post('store', 'FaqController@store')->name('faq.store');
    Route::get('edit/{id}', 'FaqController@edit')->name('faq.edit');
    Route::post('update', 'FaqController@update')->name('faq.update');
    Route::get('show/{id}', 'FaqController@show')->name('faq.show');
    Route::delete('delete/{id}', 'FaqController@delete');
    Route::get('status','FaqController@Status_Update')->name('faq.status');
    //about details section routes ends
});

//post details section routes starts
Route::group(['prefix' => 'category','middleware'=>'auth'], function () {
    Route::get('/', 'CategoryController@index')->name('category.index');
    Route::post('store', 'CategoryController@store')->name('category.store');
    Route::get('edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::post('update', 'CategoryController@update')->name('category.update');
    Route::get('show/{id}', 'CategoryController@show')->name('category.show');
    Route::delete('delete/{id}', 'CategoryController@delete');

    //post management section routes
    Route::patch('request/{id}','CategoryController@Request')->name('Request');
    Route::get('Status_Update','CategoryController@Status_Update')->name('category.status_update');
    //post details section routes ends
});

//genre details section routes starts
Route::group(['prefix' => 'genre','middleware'=>'auth'], function () {
    Route::get('/', 'GenreController@index')->name('genre.index');
    Route::post('store', 'GenreController@store')->name('genre.store');
    Route::get('edit/{id}', 'GenreController@edit')->name('genre.edit');
    Route::post('update', 'GenreController@update')->name('genre.update');
    Route::get('show/{id}', 'GenreController@show')->name('genre.show');
    Route::delete('delete/{id}', 'GenreController@delete');

    //post management section routes
    Route::patch('request/{id}','GenreController@Request')->name('Request');
    Route::get('Status_Update','GenreController@Status_Update')->name('genre.status_update');
    //post details section routes ends
});

//genre details section routes starts
Route::group(['prefix' => 'type','middleware'=>'auth'], function () {
    Route::get('/', 'TypeController@index')->name('type.index');
    Route::post('store', 'TypeController@store')->name('type.store');
    Route::get('edit/{id}', 'TypeController@edit')->name('type.edit');
    Route::post('update', 'TypeController@update')->name('type.update');
    Route::get('show/{id}', 'TypeController@show')->name('type.show');
    Route::delete('delete/{id}', 'TypeController@delete');

    //post management section routes
    Route::patch('request/{id}','TypeController@Request')->name('Request');
    Route::get('Status_Update','TypeController@Status_Update')->name('type.status_update');
    //post details section routes ends
});

//continent routes starts
Route::group(['prefix' => 'continent','middleware'=>'auth'], function () {
    Route::get('/', 'ContinentController@index')->name('continent.index');
    Route::post('store', 'ContinentController@store')->name('continent.store');
    Route::get('edit/{id}', 'ContinentController@edit')->name('continent.edit');
    Route::post('update', 'ContinentController@update')->name('continent.update');
    Route::delete('delete/{id}', 'ContinentController@delete');
    Route::patch('request/{id}','ContinentController@Request')->name('Request');
});
//continent routes ends

//country routes starts
Route::group(['prefix' => 'country','middleware'=>'auth'], function () {
    Route::get('/', 'CountryController@index')->name('country.index');
    Route::post('store', 'CountryController@store')->name('country.store');
    Route::get('edit/{id}', 'CountryController@edit')->name('country.edit');
    Route::post('update', 'CountryController@update')->name('country.update');
    Route::delete('delete/{id}', 'CountryController@delete');
    Route::patch('request/{id}','CountryController@Request')->name('Request');
});
//country riutes ends

//language routes starts
Route::group(['prefix' => 'language','middleware'=>'auth'], function () {
    Route::get('/', 'LanguageController@index')->name('language.index');
    Route::post('store', 'LanguageController@store')->name('language.store');
    Route::get('edit/{id}', 'LanguageController@edit')->name('language.edit');
    Route::post('update', 'LanguageController@update')->name('language.update');
    Route::delete('delete/{id}', 'LanguageController@delete');
    Route::patch('request/{id}','LanguageController@Request')->name('Request');
});
//language routes ends

//country routes starts
Route::group(['prefix' => 'state','middleware'=>'auth'], function () {
    Route::get('/', 'StateController@index')->name('state.index');
    Route::post('store', 'StateController@store')->name('state.store');
    Route::get('edit/{id}', 'StateController@edit')->name('state.edit');
    Route::post('update', 'StateController@update')->name('state.update');
    Route::delete('delete/{id}', 'StateController@delete');

    Route::patch('request/{id}','StateController@Request')->name('Request');
});
//country riutes ends

//city routes starts
Route::group(['prefix' => 'city','middleware'=>'auth'], function () {
    Route::get('/', 'CityController@index')->name('city.index');
    Route::post('store', 'CityController@store')->name('city.store');
    Route::get('edit/{id}', 'CityController@edit')->name('city.edit');
    Route::post('update', 'CityController@update')->name('city.update');
    Route::delete('delete/{id}', 'CityController@delete');

    Route::patch('request/{id}','CityController@Request')->name('Request');
});
//city routes ends

//radio details section routes starts
Route::group(['prefix' => 'slider','middleware'=>'auth'], function () {
    Route::get('/', 'SliderController@index')->name('slider.index');
    Route::post('store', 'SliderController@store')->name('slider.store');
    Route::get('edit/{id}', 'SliderController@edit')->name('slider.edit');
    Route::post('update', 'SliderController@update')->name('slider.update');
    Route::get('show/{id}', 'SliderController@show')->name('slider.show');
    Route::delete('delete/{id}', 'SliderController@delete');
    Route::get('status','SliderController@Status_Update')->name('slider.change_status');
});
//slider details ends


//front end section routes start
Route::get('/', 'PagesController@homepage')->name('homepage');
Route::get('/service','PagesController@service')->name('service');
Route::get('/view/{id}', 'PagesController@view')->name('property.view');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/about/{slug}', 'PagesController@showabout')->name('about.show');
Route::get('/faq', 'PagesController@faq')->name('faq');
Route::get('/search', 'PagesController@advancesearch')->name('advancesearch');
Route::POST('/comment', 'CommentController@store')->name('comments.store');
Route::delete('comment/{id}', 'CommentController@delete')->name('comment.delete');
Route::get('comment/edit/{id}', 'CommentController@edit')->name('comment.edit');
Route::POST('comment/update', 'CommentController@update')->name('comment.update');
Route::POST('/contact', 'PagesController@store')->name('contact.store');
Route::POST('/report', 'PagesController@report')->name('report.store');
Route::get('/blog', 'PagesController@blog')->name('blog');
Route::get('/blog/{slug}', 'PagesController@showblog')->name('blog.show');


Route::get('/home/radio', 'PagesController@radios')->name('radios');
Route::get('/blog/category/{category_id}', 'PagesController@category')->name('blogs.category');
Route::get('/radios/local', 'PagesController@radioslocal')->name('radio.local');
Route::get('/radios/region', 'PagesController@radiosregion')->name('radio.region');
Route::get('/radios/recents', 'PagesController@recent')->name('radio.recent');
Route::get('/radios/trending', 'PagesController@trending')->name('radio.trending');
Route::get('/radios/region/{continent}', 'PagesController@continentview')->name('radio.continentview');
Route::get('/radios/country/{country}', 'PagesController@countryview')->name('radio.countryview');
Route::get('/radios/state/{state}', 'PagesController@stateview')->name('radio.stateview');
Route::get('/radios/city/{city}', 'PagesController@cityview')->name('radio.cityview');
Route::get('/radios/language', 'PagesController@language')->name('radio.language');
Route::get('/radios/language/{language}', 'PagesController@languageview')->name('radio.languageview');
Route::get('/radios/{language}/{category}', 'PagesController@langcatview')->name('radio.langcatview');
Route::get('/Radio/{radio}', 'PagesController@radioview')->name('radio.view');

Route::get('/getsearch', 'PagesController@getsearch')->name('radio.getsearch');
Route::get('/postsearch', 'PagesController@postsearch')->name('radio.postsearch');

Route::group(['middleware'=>'auth'],function() {
Route::get('/radios/favorite', 'PagesController@myfavorite')->name('favorites.index');
Route::get('/favorite', 'PagesController@favorite')->name('favorite.store');
Route::DELETE('/favorite/delete/{id}', 'PagesController@deletefavorite')->name('favorite.delete');
});
//front end section routes ends


//sitemap routes starts

//sitmap routes ends

//optimize clear start
Route::get('/optimize-clear', function() {
    $exitCode = Artisan::call('optimize:clear');
    return 'optimize cleared';
});
//optimize clear end
