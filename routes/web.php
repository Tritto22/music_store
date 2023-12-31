<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Authentication
Auth::routes();

// Backoffice
Route::prefix("admin")->namespace("Admin")->middleware("auth")->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource("instruments", "InstrumentController");
    Route::resource("categories", "CategoryController");
    Route::resource("tags", "TagController");
});

// Frontoffice
Route::get("{any?}", function(){
    return redirect('http://localhost:8080');
})->where("any", ".*");