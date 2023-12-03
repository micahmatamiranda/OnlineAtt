<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\LogController;
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
})->name('login')->middleware('guest');
Route::get('/dashboard', [LogController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/auth/redirect', [GoogleAuthController::class, 'redirect'])->name('google-redirect');
Route::get('/auth/callback', [GoogleAuthController::class, 'callback']);

Route::post('/logs-process', [LogController::class, 'store']);

Route::post('/logout', [GoogleAuthController::class, 'logout']);
