<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\userController;
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
Route::get('dashboard', [menuController::class, 'viewMenu'])
    ->name('dashboard')
    ->middleware(['auth']);
Route::get('food', [menuController::class, 'viewDetails']);
Route::get('setting', [menuController::class, 'setting']);
Route::get('order-list', [orderController::class, 'viewOrder'])->name('orderlist');
Route::get('payment-gateway', [orderController::class, 'processPayment']);
Route::get('insertOrder', [orderController::class, 'insertOrder'])->name('controltest');
Route::get('deleteOrder', [orderController::class, 'deleteOrder']);
Route::get('deleteItem', [orderController::class, 'deleteItem']);
Route::get('restoreOrder', [orderController::class, 'restoreOrder']);
Route::get('updateOrder', [orderController::class, 'updateOrder']);
Route::get('paidOrder', [orderController::class, 'paidOrder']);
Route::get('successOrder', [orderController::class, 'successOrder']);
Route::get('order-history', [orderController::class, 'viewHistory']);
Route::get('test', [IndexController::class, 'test']);
Route::get('logout', [IndexController::class, 'logout']);
