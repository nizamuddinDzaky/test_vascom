<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\AdminLoginController;
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
URL::forceRootUrl(getenv('APP_URL'));
Route::get('/', [HomeController::class, 'register'])->name('home');
Route::post('/register', [CustomerRegisterController::class, 'register'])->name('customer.post_register');


// admin
Route::group(['prefix' => 'admin'], function() {
    Route::get('/login', [AdminLoginController::class, 'index'])->name('administrator.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('administrator.post_login');

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('administrator.logout');
        Route::get('/list-user', [AdminLoginController::class, 'list_user'])->name('administrator.list.user');
    });
});
