<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationJobController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Rutas para los Trabajos
Route::get('/jobs/{id}', [JobController::class, 'edit'])->name('jobs.edit');
// Route::get('/applications-job/{job}', [ApplicationJobController::class, 'show'])->name('employer.applications');
Route::put('/jobs/{id}', [JobController::class, 'update']);
