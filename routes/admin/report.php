<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'auth'], function () {
    Route::get('admin/report','ReportController@index')->name('report.index');
    Route::get('admin/report/{id}','ReportController@show')->name('report.show');
    Route::DELETE('admin/report/{id}','ReportController@destroy')->name('report.destroy');
});