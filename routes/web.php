<?php

use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index');
Route::post('/send','HomeController@send')->name('send');
Route::post('/getUploadedFiles','HomeController@getUploadedFiles')->name('getUploadedFiles');
