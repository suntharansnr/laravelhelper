<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'auth'], function () {
    Route::get('meta','MetaController@index')->name('meta.index');
    Route::get('meta/{id}/edit','MetaController@edit')->name('meta.edit');
    Route::POST('meta','MetaController@store')->name('meta.store');
});