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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/client', [\App\Http\Controllers\ClientController::class, 'index']);
Route::post('/client/update/{id}', [\App\Http\Controllers\ClientController::class, 'update']);
Route::post('/order/store/', [\App\Http\Controllers\ClientController::class, 'store']);

Route::get('/order', [\App\Http\Controllers\OrderController::class, 'index']);
Route::post('/order/store/{email}', [\App\Http\Controllers\OrderController::class, 'store']);
Route::post('/order/update/{id}', [\App\Http\Controllers\OrderController::class, 'update']);
