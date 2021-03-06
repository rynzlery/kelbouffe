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

/*Route::get('/', function () {
    return view('pages.index');
});*/

Auth::routes();
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/', 'HomeController@Index');
Route::post('/Create', 'HomeController@Create');

/*AJAX calls*/
Route::get('/AddNote', 'HomeController@AddNote');
Route::post('/CreateNote', 'HomeController@CreateNote');
Route::get('/EditPlat', 'HomeController@EditPlat');
Route::post('/UpdatePlat', 'HomeController@UpdatePlat');
Route::post('/DeletePlat', 'HomeController@DeletePlat');