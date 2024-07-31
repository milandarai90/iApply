<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\SearchApiController;

Route::post('/register', [ApiController::class, 'register']);
Route::post('/verify_otp', [ApiController::class, 'verifyOtp']);
Route::post('/resend_otp', [ApiController::class, 'resendOtp']);
Route::post('/login', [ApiController::class, 'login'])->name('custom-login');

// Protect the /home route with auth.custom middleware
Route::middleware('auth:sanctum')->get('/home', [ApiController::class, 'home']);
Route::middleware('auth:sanctum')->post('/logout', [ApiController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/search', [SearchApiController::class, 'search']);


