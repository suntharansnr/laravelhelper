<?php
use Illuminate\Support\Facades\Route;

//spatie laravel role based management
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
});
//spatie laravel role based management