<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
Route::get('/register', function () {
    return view('register');
});

Route::get('/bookdetail', function () {
    return view('bookdetail');
});
Route::prefix('bookdetail')->group(function () {
Route::resource('','\App\Http\Controllers\detailController');

 });    

Route::prefix('register')->group(function () {
    Route::post('createUser','\App\Http\Controllers\regisController@createUser');
    Route::post('login','\App\Http\Controllers\regisController@login');
    });

Route::prefix('bookvaccine')->group(function () {
Route::resource('','\App\Http\Controllers\bookvaccineController');
Route::post('saveBookVac','\App\Http\Controllers\bookvaccineController@saveBookVac');
Route::post('checkbookdata','\App\Http\Controllers\bookvaccineController@checkbookdata');
});    

Route::prefix('bookdetail')->group(function () {
    Route::resource('','\App\Http\Controllers\detailController');
    Route::post('index','\App\Http\Controllers\detailController@index');
    });