<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

//landing
Route::get('/', [LoginController::class, 'index'])->name('landing');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::middleware('auth')->group(function(){
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    //user
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    //Food
    Route::get('/food', [FoodController::class, 'index'])->name('food.index');
    Route::get('/food/create', [FoodController::class, 'create'])->name('food.create');
    Route::post('/food', [FoodController::class, 'store'])->name('food.store');
    Route::get('/food/edit/{id}', [FoodController::class, 'edit'])->name('food.edit');
    Route::put('/food/{id}', [FoodController::class, 'update'])->name('food.update');
    Route::delete('/food/{id}', [FoodController::class, 'destroy'])->name('food.destroy');

});


