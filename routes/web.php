<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::get('/', [NoteController::class, 'home']);
Route::get('/create', [NoteController::class, 'create']);
Route::post('/store', [NoteController::class, 'storeWeb']);
Route::get('/summary/{note}', [NoteController::class, 'summaryWeb']);
Route::get('/edit/{note}', [NoteController::class, 'edit']);
Route::post('/update/{note}', [NoteController::class, 'updateWeb']);
Route::post('/delete/{note}', [NoteController::class, 'deleteWeb']);
