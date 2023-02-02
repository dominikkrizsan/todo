<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();



Route::group(['middleware' => 'auth'], function () {
    Route::get('/', "App\Http\Controllers\TaskController@index")->name('home');
    Route::get("task/create", "App\Http\Controllers\TaskController@create");
    Route::post('task/store', 'App\Http\Controllers\TaskController@saveTask');
    Route::delete('task/{id}', 'App\Http\Controllers\TaskController@destroy')->name('task.destroy');
    Route::get("task/edit/{id}", "App\Http\Controllers\TaskController@editTask");
    Route::post("task/update/{id}", "App\Http\Controllers\TaskController@updateTask");
});
