<?php
use Illuminate\Support\Facades\Route;

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