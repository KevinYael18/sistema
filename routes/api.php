<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoApiController;

Route::get('/productos', [ProductoApiController::class, 'index']);
Route::get('/productos/{id}', [ProductoApiController::class, 'show']);
Route::post('/productos', [ProductoApiController::class, 'store']);
Route::put('/productos/{id}', [ProductoApiController::class, 'update']);
Route::delete('/productos/{id}', [ProductoApiController::class, 'destroy']);