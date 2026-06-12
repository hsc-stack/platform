<?php

use App\Http\Controllers\NodeController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SubjectController::class, 'index']);
Route::get('/{subject:slug}', [SubjectController::class, 'show']);
Route::get('/{subject:slug}/{path}', [NodeController::class, 'show'])->where('path', '.*');
