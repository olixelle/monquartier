<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\NeighborhoodController;
use App\Http\Controllers\API\PublicMessageController;
use App\Http\Controllers\API\OfferController;
use Illuminate\Support\Facades\Route;

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/neighborhood', [NeighborhoodController::class, 'index']);

// Routes protégées (nécessitent un token)
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/publicmessage', [PublicMessageController::class, 'index']);
    Route::post('/publicmessage', [PublicMessageController::class, 'publish']);

    Route::get('/offer/category', [OfferController::class, 'getCategories']);
    Route::get('/offer', [OfferController::class, 'index']);
});
