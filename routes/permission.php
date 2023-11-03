<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Permission Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Permission management section routes starts
Route::group(['prefix' => 'admin/permissions','middleware'=>'auth'], function () {
    Route::get('/', 'PermissionsController@index')->name('permissions.index');
    Route::match(['get', 'put'], 'edit/{id}', 'PermissionsController@edit')->name('permissions.edit');
    Route::get('show/{id}', 'PermissionsController@show')->name('permissions.show');
    Route::delete('delete/{id}', 'PermissionsController@destroy')->name('permission.delete');
    Route::post('store', 'PermissionsController@store')->name('permission.store');
    Route::get('Status_Update','PermissionsController@Status_Update')->name('Status_Update');
});
//Permission management section routes ends
