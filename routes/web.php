<?php

use App\Http\Controllers\NodeController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::inertia('/privacy-policy', 'legal/PrivacyPolicy');
Route::inertia('/terms-service', 'legal/TermsConditions');
Route::inertia('/join', 'platform/JoinTeam');
Route::inertia('/about-us', 'platform/AboutUs');

Route::get('/', [SubjectController::class, 'index']);
Route::get('/resources/{resource:id}', [ResourceController::class, 'show']);
Route::get('/{subject:slug}', [SubjectController::class, 'show']);
Route::get('/{subject:slug}/{path}', [NodeController::class, 'show'])->where('path', '.*');
