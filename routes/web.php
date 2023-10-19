<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
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
    return view('user.user_viewCartPage');
});
*/

//Remember to uncomment the code below


Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/home', function() {
    return view('welcome');
})->name('home');
Route::get('/', [AuthManager::class, 'signUp'])->name('signUp');
Route::post('/', [AuthManager::class, 'signUpPost'])->name('signUp.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

