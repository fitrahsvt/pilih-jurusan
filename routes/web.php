<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
// Route::get('/category', [CategoryController::class, 'create'])->name('category.create');
// Route::get('/category', [CategoryController::class, 'update'])->name('category.update');
// Route::get('/category', [CategoryController::class, 'delete'])->name('category.delete');

Route::get('/product', [ProductController::class, 'index'])->name('product.index');

Route::get('/user', [UserController::class, 'index'])->name('user.index');

// Route::get('/add-user', [UserController::class, 'adduser']);

// Route::get('/detail-user', [UserController::class, 'detailuser']);

// Route::get('/edit-user', [UserController::class, 'edituser']);

// Route::get('/produk', [UserController::class, 'produk']);

Route::get('/role', [RoleController::class, 'index'])->name('role.index');
