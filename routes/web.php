<?php

use App\Activity;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ActivityController@show');

Route::post('/', 'ActivityController@store');

Route::put('/', 'ActivityController@update');

Route::get('/attachments', 'AttachmentController@show');

Route::delete('/attachments', 'AttachmentController@destroy');
