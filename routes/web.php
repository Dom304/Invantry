<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CollectionItemController;
use App\Http\Controllers\CartController;
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

Route::get('/home', [StoreController::class, 'index'])->name('home');

Route::get('/store/{storeName}', [ItemController::class, 'index'])->name('store');
Route::post('/store/{storeName}', [CartController::class, 'insert'])->name('cart.add');

Route::get('/collection/{collName}', [CollectionItemController::class, 'index']);

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/', [AuthManager::class, 'signUp'])->name('signUp');
Route::post('/', [AuthManager::class, 'signUpPost'])->name('signUp.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

//delete after
Route::put('/home', [StoreController::class, 'updateRole'])->name('updateRole');

Route::get('/adminDashboard', [StoreController::class, 'dashboard'])->name('adminDashboard');
