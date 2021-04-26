<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\indexController;
use App\Http\Controllers\loginController;
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
    Route::get('/', [indexController::class, 'index'])->name('home');
   
    Route::get('/login', [loginController::class, 'index'])->name('login.get');
    Route::post('/login', [loginController::class, 'view'])->name('login');  
    
    Route::get('/logout', [loginController::class, 'logout'])->name('logout');

