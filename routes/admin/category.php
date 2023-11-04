<?php
use Illuminate\Support\Facades\Route;

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