<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::post('/notes/{note}/summary', [NoteController::class, 'generateSummary']);
Route::get('/notes/search', [NoteController::class, 'search']);
Route::apiResource('notes', NoteController::class);
