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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("alias/{alias}", "\App\Http\Controllers\LinkController@redirect")->name("tiny-link");

Route::middleware(["auth"])->prefix("admin")->group(function(){
    Route::get("/", "\App\Http\Controllers\LinkController@getDashboard")->name("alias.dashboard");
    Route::get("aliases", "\App\Http\Controllers\LinkController@index")->name("alias.aliases");
    Route::get("aliases/{id}", "\App\Http\Controllers\LinkController@show")->name("alias.alias");
    Route::get("update-alias/{id}", "\App\Http\Controllers\LinkController@showUpdateForm")->name("alias.show-update-form");
    Route::get("create-alias", "\App\Http\Controllers\LinkController@showCreateAliasForm")->name("alias.create-alias-form");
    Route::post("update-alias/{id}", "\App\Http\Controllers\LinkController@updateAlias")->name("alias.update-alias");
    Route::post("delete-alias/{id}", "\App\Http\Controllers\LinkController@deleteAlias")->name("alias.delete-alias");
    Route::post("create-alias", "\App\Http\Controllers\LinkController@createAlias")->name("alias.create-alias");
});
