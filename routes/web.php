<?php

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

Route::get('/home', 'HomeController@index')->name('home');

// PUBLIC ROUTES
Route::get('/ar', function () {
    return view('public.ar');
})->name('ar');
Route::get('/contatti', function () {
    return view('contatti');
});


// PROFILO
Route::get('/password/edit','Auth\ResetPasswordController@edit')->middleware('auth')->name('password.edit');
Route::post('/password/edit','Auth\ResetPasswordController@updatePassword')->middleware('auth')->name('password.edit');

Route::get('/profilo/create','ProfiloController@create')->middleware('auth')->name('profilo.create');
Route::post('/profilo/store','ProfiloController@store')->middleware('auth')->name('profilo.store');
// For a route with the following URI: profile/{id}
Route::get('/profilo/edit/{id}','ProfiloController@edit')->middleware('auth')->name('profilo.edit');
Route::post('/profilo/update/{id}','ProfiloController@update')->middleware('auth')->name('profilo.update');