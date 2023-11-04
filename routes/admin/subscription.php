<?php
use Illuminate\Support\Facades\Route;

//Subscriptions section routes starts


Route::group(['prefix' => 'subscriptions','middleware'=>'auth'], function () {
    Route::get('/', 'SubscriptionController@index')->name('subscriptions.index');
    Route::match(['get', 'put'], 'edit/{id}', 'SubscriptionController@edit')->name('subscriptions.edit');
    Route::get('show/{id}', 'SubscriptionController@show')->name('subscriptions.show');
    Route::delete('delete/{id}', 'SubscriptionController@destroy')->name('subscriptions.delete');
    Route::post('store', 'SubscriptionController@store')->name('subscriptions.store');
    Route::get('Status_Update','SubscriptionController@Status_Update')->name('Status_Update');
});
//Subscriptions section routes ends