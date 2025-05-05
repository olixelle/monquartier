<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/images/{filename}', [App\Http\Controllers\ImageController::class, 'show'])->name('image.show');

