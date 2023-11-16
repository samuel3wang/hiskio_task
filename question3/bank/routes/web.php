<?php

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
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

// Route::get('/', function () {
//     return view('layout');
// });

Route::get('/login',     [AuthController::class, 'login'])->name('login');
Route::post('/login',    [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/register',  [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/logout',    [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    Route::get('/accounts',       [BankController::class], 'accounts')->name('accounts');

    Route::get('/accounts/{id}',  [BankController::class], 'balances')->name('balances');
    Route::post('/accounts/{id}', [BankController::class], 'balancesPost')->name('balances.post');
});

// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/accounts', function () {
//         return view('accounts');
//     });
// });
// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/accounts/:id', function () {
//         return view('balances');
//     });
// });
// Route::group(['middleware' => ['auth']], function () {
//     Route::post('/accounts/:id', function () {
//         return view('balances');
//     });
// });