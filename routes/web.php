<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\indexController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\settingsController;
use App\Http\Controllers\companyController;
use App\Http\Controllers\customFieldController;
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
    //HOME
    Route::get('/', [indexController::class, 'index'])->name('home');
    //SETTINGS
    Route::get('/system-setup', [settingsController::class, 'index'])->name('settings');
    Route::post('/system-setup', [settingsController::class, 'update'])->name('settings.post');
    //Company
    Route::get('/company', [companyController::class, 'index'])->name('company');
    Route::post('/company', [companyController::class, 'update'])->name('company.post');
    //LOGIN
    Route::get('/login', [loginController::class, 'index'])->name('login.get');
    Route::post('/login', [loginController::class, 'view'])->name('login');  
    //LOGOUT
    Route::get('/logout', [loginController::class, 'logout'])->name('logout');

    //Custom Field
    Route::post('/custom_field', [customFieldController::class, 'update'])->name('custom_field.post'); 

