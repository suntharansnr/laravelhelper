<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'auth'], function () {
    Route::get('theme','ThemeController@index')->name('theme.index');
    Route::get('theme/edit/{id}','ThemeController@edit')->name('theme.edit');
    Route::POST('admin/theme','ThemeController@store')->name('theme.store');
});