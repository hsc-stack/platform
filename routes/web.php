<?php

use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SubjectController::class, 'index']);
