<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\JobController;
use Illuminate\Http\Request;


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
})->name('welcome');

Route::middleware(['guest'])->group(function () {
    Route::get('/register/employer', [UserController::class, 'viewEmployer'])->name('register.employer');
    Route::post('/register/employer', [UserController::class, 'createEmployer'])->name('register.createEmployer');
    Route::get('/register/candidate', [UserController::class, 'viewCandidate'])->name('register.candidate');
});
Route::get('/dashboard', function (Request $request) {
        $redirect_url = $request->user()->hasRole('candidato') ? '/candidate/dashboard' : "/employer/dashboard";
        return redirect($redirect_url);
    })->name('dashboard');

// Route::middleware(['auth:sanctum', 'check.role:candidato', config('jetstream.auth_session'), 'verified'])->group(function () {
// });

Route::middleware(['auth:sanctum', 'check.role:empleador', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/employer/dashboard', [JobController::class, 'index'])->name('employer.dashboard');
    Route::resource('jobs', JobController::class);
});

Route::middleware(['auth', 'check.role:empleador'])->group(function () {
    Route::get('/employer/dashboard', [JobController::class, 'index'])->name('employer.dashboard');
    Route::resource('jobs', JobController::class);
});

Route::middleware(['auth', 'check.role:candidato'])->group(function () {
});
