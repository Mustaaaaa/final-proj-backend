<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\DishController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\TypeController;
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


Route::get('companies', [CompanyController::class, 'index']);

Route::get('companies/{company:slug}', [CompanyController::class, 'show']);

Route::get('dishes', [DishController::class, 'index']);

Route::get('dishes/{dish:slug}', [DishController::class, 'show']);

Route::get('types', [TypeController::class,'index']);

Route::get('types/{type:slug}', [TypeController::class,'select']);

Route::post('types/select', [TypeController::class, 'select']);

Route::post('/validate-order', [OrderController::class, 'validateOrder']);

Route::post('/orders', [OrderController::class, 'store']);