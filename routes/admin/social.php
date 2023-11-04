<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'auth'], function () {
    Route::get('social-urls','SocialController@index')->name('social-urls.index');
    Route::get('social-urls/{id}/edit','SocialController@edit')->name('social-urls.edit');
    Route::POST('social-urls','SocialController@store')->name('social-urls.store');
});