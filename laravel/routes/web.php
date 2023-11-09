<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FileController;

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

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::get('/dashboard', function (Request $request) {
    $request->session()->flash('info', 'TEST flash messages (=^·W·^=)');
    return view('dashboard');
 })->middleware(['auth','verified'])->name('dashboard');;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('mail/test', [MailController::class, 'test']);
// or
// Route::get('mail/test', 'App\Http\Controllers\MailController@test');

Route::resource('files', FileController::class);

Route::get('/files/{file}/edit', [FileController::class, 'edit'])->name('files.edit');
Route::put('/files/{file}', [FileController::class, 'update'])->name('files.update');

Route::resource('files', FileController::class)
->middleware(['auth', 'role:3']);

//error multirole.any no existe
/* Route::resource('files', FileController::class)
->middleware(['auth', 'multirole.any:2,3']); */
/* Route::resource('files', FileController::class)
    ->middleware(['auth', 'multirole:1,3']); */


require __DIR__.'/auth.php';
