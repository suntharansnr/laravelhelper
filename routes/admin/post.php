<?php
use Illuminate\Support\Facades\Route;
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