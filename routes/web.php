<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// registro y autenticación 
Route::get('/register/employer', [UserController::class, 'viewEmployer'])->name('register.employer')->middleware('guest');
Route::get('/register/candidate', [UserController::class, 'viewCandidate'])->name('register.candidate')->middleware('guest');

Route::post('/register/employer', [UserController::class, 'createEmployer'])->name('register.createEmployer')->middleware('guest');
