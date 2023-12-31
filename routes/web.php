<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CollectionItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ManagerRequestController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GenericDeleteController;

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
//for inserting into collection from store page
Route::post('/store/{storeName}/add-to-collection', [CartController::class, 'insertCol'])->name('store.collection.add');
Route::get('/Public-collections', [CollectionController::class, 'index'])->name('public.collectionsPage');

//for inserting into cart from right window
Route::get('/collection/{collName}', [CollectionItemController::class, 'index'])->name('collection');
Route::delete('/collection/{collName}/delete/{itemId}', [CollectionItemController::class, 'destroy'])->name('collection.item.delete');
Route::post('/collection/{collName}', [CartController::class, 'insertRight'])->name('cart.add');
//for inserting into collection from right window
Route::post('/collection/{collName}/add-to-collection', [CartController::class, 'insertRightCol'])->name('collection.add');


Route::get('/', [AuthManager::class, 'login'])->name('login');
Route::post('/', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/signUp', [AuthManager::class, 'signUp'])->name('signUp');
Route::post('/signUp', [AuthManager::class, 'signUpPost'])->name('signUp.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

//delete after
Route::put('/home', [StoreController::class, 'updateRole'])->name('updateRole');

Route::get('/AdminDashboard', [StoreController::class, 'adminDashboard'])->name('adminDashboard');
Route::get('/ModeratorDashboard', [StoreController::class, 'moderatorDashboard'])->name('moderatorDashboard');
Route::get('/ManagerDashboard', [StoreController::class, 'managerDashboard'])->name('managerDashboard');

//updating store for admin and moderator
Route::put('/ManagerDashboard/{store}', [StoreController::class, 'updateStore'])->name('updateStore');
Route::put('/AdminDashboard/{store}', [StoreController::class, 'updateStore'])->name('updateStore');

Route::post('/addItem/{store}', [StoreController::class, 'addItem'])->name('addItem');
Route::delete('/deleteItem/{store}/{item}', [StoreController::class, 'deleteItem'])->name('deleteItem');
Route::get('/store/{store}/item/{item}/edit', [StoreController::class, 'edit'])->name('editItem');
Route::put('/store/{store}/item/{item}', [StoreController::class, 'update'])->name('updateItem');

// Check this route in your web.php file
Route::post('/request/{requestId}', [ManagerRequestController::class, 'acceptRequest'])->name('manager.request.accept');


Route::post('/user/{id}', [StoreController::class, 'deleteUser'])->name('deleteUser');
Route::post('/store/{store}', [StoreController::class, 'deleteStore'])->name('deleteStore');

//Using this route for deleting any entity
Route::post('/delete/{type}/{id}', [GenericDeleteController::class, 'delete'])->name('generic.delete');

Route::post('/home', [CollectionController::class, 'createCollection'])->name('collections.create');
Route::get('/refresh', [StoreController::class, 'refreshTable'])->name('users.refreshTable');

Route::get('/manager-request', [ManagerRequestController::class, 'create'])->name('manager.request.create');
Route::post('/manager-request', [ManagerRequestController::class, 'store'])->name('manager.request.store');

//for deleting a collection
Route::post('/collection/delete/{id}', [CollectionController::class, 'delete'])->name('collection.delete');



Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
//route for processing checkout
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::put('/user/{id}', [StoreController::class, 'updateUser']);
