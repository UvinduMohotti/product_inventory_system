<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public route
Route::post('/login', [AuthController::class, 'login']);


//protected route
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'findAllUser'])->middleware('accessRole:admin');
    Route::post('/register', [AuthController::class, 'register'])->middleware('accessRole:admin');

    Route::get('/category', [ProductController::class, 'findAllCategory'])->middleware('accessRole:admin');

    Route::post('/product', [ProductController::class, 'store'])->middleware('accessRole:admin');
    Route::post('/product-update/{id}', [ProductController::class, 'update'])
        ->middleware('accessRole:admin');
    Route::post('/product/update-quantity/{id}', [ProductController::class, 'updateQuantity'])
        ->middleware('accessRole:admin');
    Route::delete('/product/{id}', [ProductController::class, 'delete'])->middleware('accessRole:admin');
    Route::get('/product/{id}', [ProductController::class, 'search']);
    Route::get('/product', [ProductController::class, 'findAll']);
});
