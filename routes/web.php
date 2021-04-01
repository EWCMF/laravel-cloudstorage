<?php

use App\Http\Controllers\CheckFileController;
use App\Http\Controllers\DisplayFileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SettingsController;
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

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/home/{path?}', [HomeController::class, 'index'])->name('home')->middleware('auth')->where('path', '.*');
Route::post('/home', [HomeController::class, 'fileUpload'])->middleware('auth');
Route::post('/new-dir', [HomeController::class, 'newDirectory'])->name('home.new.dir')->middleware('auth');
Route::get('/delete/{id}', [HomeController::class, 'fileDelete'])->name('home.delete')->middleware('auth');

Route::get('/check/{id}', [CheckFileController::class, 'check'])->name('check')->middleware('auth');

Route::get('/display/image/{id}', [DisplayFileController::class, 'image'])->name('display.image')->middleware('auth');
Route::get('/display/audio/{id}', [DisplayFileController::class, 'audio'])->name('display.audio')->middleware('auth');
Route::get('/display/video/{id}', [DisplayFileController::class, 'video'])->name('display.video')->middleware('auth');
Route::get('/display/load/{id}', [DisplayFileController::class, 'load'])->name('display.load')->middleware('auth');
Route::get('/display/download/{id}', [DisplayFileController::class, 'download'])->name('display.download')->middleware('auth');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return redirect('/home');
});
