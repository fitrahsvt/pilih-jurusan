<?php

use App\Http\Controllers\API\FoodController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//info
Route::get('/', [UserController::class, 'info']);

Route::middleware('auth:sanctum')->group(function () {
    //logout
    Route::get('logout', [UserController::class, 'logout']);
    //Foods
    Route::prefix('foods')->group(function() {
        Route::get('', [FoodController::class, 'index']);
        Route::get('/{id}', [FoodController::class, 'show']);
        Route::post('', [FoodController::class, 'store']);
        Route::put('/{id}', [FoodController::class, 'update']);
        Route::delete('/{id}', [FoodController::class, 'destroy']);
    });
});


//authenticate
Route::post('users/autenticate', [UserController::class, 'login']);
