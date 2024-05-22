<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/', [HomepageController::class, 'index'])->name('showIndex');
route::get('/register', [AuthController::class, 'registerDisplay'])->name('registerDisplay');
route::get('/login', [AuthController::class, 'loginDisplay'])->name('loginDisplay');

