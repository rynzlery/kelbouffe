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
Route::post('/AddNote', 'HomeController@AddNote');
Route::post('/AddNote', function () {
    return Response::json(array('name' => 'risotto maison', 'id' => '10'));
});
Route::post('/CreateNote', 'HomeController@CreateNote');