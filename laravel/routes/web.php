<?php

/*use Illuminate\Support\Facades\Route;*/
/*use Illuminate\Support\Facades\Log;*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

/*
Route::get('/', function () {
   Log::info('Loading welcome page');
   return view('welcome');
});
*/

Route::get('/', function () {
   Debugbar::info('hola');
   return view('welcome');
});
