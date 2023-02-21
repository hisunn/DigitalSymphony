<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\menuController;
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

Route::get('/',  [IndexController::class, 'index']);

Route::get('dashboard', [IndexController::class, 'session'])
    ->name('dashboard')
    ->middleware(['auth']);

Route::get('/dashboard', [menuController::class, 'viewMenu']);

Route::get('/test', [menuController::class, 'viewMenu']);

Route::get('/food', [menuController::class, 'viewDetails']);

Route::get('/insertOrder', [menuController::class, 'insertOrder']);

Route::get('/setting', [menuController::class, 'setting']);


