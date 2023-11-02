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

/*
Route::get('/', function () {
    return view('admin.admin_dashboard');
});
*/

Route::get('/home', [StoreController::class, 'index'])->name('home');
Route::get('/store/{storeName}', [ItemController::class, 'index']);
Route::get('/collection/{collName}', [CollectionItemController::class, 'index']);

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/', [AuthManager::class, 'signUp'])->name('signUp');
Route::post('/', [AuthManager::class, 'signUpPost'])->name('signUp.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{product}', 'CartController@addToCart')->name('cart.add');
Route::put('/cart/update/{cart}', 'CartController@updateCart')->name('cart.update');
Route::delete('/cart/remove/{cart}', 'CartController@removeFromCart')->name('cart.remove');

//delete after
Route::put('/home', [StoreController::class, 'updateRole'])->name('updateRole');

Route::get('/adminDashboard', [StoreController::class, 'dashboard'])->name('adminDashboard');
Route::delete('/user/{id}', [YourControllerName::class, 'deleteUser'])->name('deleteUser');
