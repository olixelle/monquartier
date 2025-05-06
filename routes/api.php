<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\NeighborhoodController;
use App\Http\Controllers\API\PublicMessageController;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\ConversationController;
use Illuminate\Support\Facades\Route;

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/neighborhood', [NeighborhoodController::class, 'index']);

// Routes protégées (nécessitent un token)
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/me', [AuthController::class, 'editMe']);

    Route::get('/neighborhood/announcement', [NeighborhoodController::class, 'announcement']);
    Route::get('/neighborhood/people', [NeighborhoodController::class, 'people']);

    Route::get('/publicmessage', [PublicMessageController::class, 'index']);
    Route::post('/publicmessage', [PublicMessageController::class, 'publish']);

    Route::get('/offer/category', [OfferController::class, 'getCategories']);
    Route::get('/offer', [OfferController::class, 'index']);
    Route::post('/offer', [OfferController::class, 'create']);
    Route::delete('/offer/{id}', [OfferController::class, 'delete']);
    Route::put('/offer/{id}', [OfferController::class, 'update']);

    Route::get('/event', [EventController::class, 'index']);
    Route::post('/event', [EventController::class, 'create']);
    Route::get('/event/{id}', [EventController::class, 'details']);
    Route::put('/event/{id}', [EventController::class, 'update']);
    Route::delete('/event/{id}', [EventController::class, 'delete']);
    Route::post('/event/{id}/subscribe', [EventController::class, 'subscribe']);
    Route::post('/event/{id}/unsubscribe', [EventController::class, 'unsubscribe']);
    Route::post('/event/{id}/message', [EventController::class, 'postMessage']);
    Route::get('/event/{id}/message', [EventController::class, 'getMessages']);
    Route::get('/event/{id}/subscriptions', [EventController::class, 'getSubscriptions']);

    Route::get('/conversations', [ConversationController::class, 'index']);
    Route::post('/conversations', [ConversationController::class, 'create']);
    Route::get('/conversations/{id}/messages', [ConversationController::class, 'getMessages']);
    Route::post('/conversations/{id}/messages', [ConversationController::class, 'addMessage']);

});
