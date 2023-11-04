<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'auth'], function () {
    Route::get('/notifications', 'UsersController@notifications');
    Route::get('admin/notifications', 'UsersController@AdminNotifications')->name('admin.notifications');
});
