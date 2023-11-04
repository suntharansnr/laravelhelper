<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'auth'], function () {
Route::get('admin/contact','ContactController@index')->name('contact.index');
Route::get('admin/contact/{id}','ContactController@show')->name('contact.show');
Route::DELETE('admin/contact/{id}','ContactController@destroy')->name('contact.destroy');
});