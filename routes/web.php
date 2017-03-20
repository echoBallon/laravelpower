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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','IndexController@index');
Route::resource('/discussions','IndexController');
Route::post('index/upload','IndexController@upload');
Route::resource('/comment','CommentsController');
Route::get('/user/register','UserController@register');
Route::get('/user/avatar','UserController@avatar');
Route::get('/user/changepassword','UserController@changepassword');
Route::post('/changepassword','UserController@postpassword');
Route::post('/avatar','UserController@changeavatar');
Route::post('/crop/api','UserController@cropavatar');
Route::post('/user/register','UserController@store');
Route::get('/user/login','UserController@login');
Route::get('/login','UserController@login');
Route::get('/logout','UserController@logout');
Route::post('/user/login','UserController@singin');
Route::get('/verify/{confirm_code}','UserController@confirmEmail');
Route::get('/success','UserController@storeSuccess');
Route::get('mail/send','MailController@send');

Route::get('/home', 'HomeController@index');
