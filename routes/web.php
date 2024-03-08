<?php

use App\Http\Controllers\ApplicationJobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\JobController;
use App\Livewire\ApplicationCandidateList;
use App\Livewire\JobsList;
use App\Livewire\JobsListCandidate;
use App\Livewire\ApplicationsList;
use Livewire\Livewire;
use Illuminate\Http\Request;
use Inertial\Inertial;


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

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->name('dashboard')->middleware(['auth', 'verified']);


Route::middleware(['auth', 'check.role:empleador', config('jetstream.auth_session'), 'verified'])->group(function () {

    // +++ RUTAS OFERTAS EMPLEADOR ++++++++++++++++++++++++++
    Route::get('/employer/dashboard', [JobController::class, 'index'])->name('employer.dashboard');
    Route::get('/mis-ofertas', JobsList::class)->name('jobs.list');
    Route::get('/applications/{jobId}', ApplicationsList::class)->name('applications.list');
    // Route::post('/jobs', JobController::class )->name('jobs.store');
    Route::post('/jobs', [JobController::class, 'store'])->name('post.store');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::resource('/jobs', JobController::class);
    Route::get('/employer/dashboard', [JobController::class, 'index'])->name('employer.dashboard');
    
});

Route::middleware(['auth', 'check.role:candidato'])->group(function () {
    
    // +++ RUTAS OFERTAS CANDIDATO +++++++++++++++++++++++++++++++++++++++++
    Route::get('/mis-aplicaciones', ApplicationCandidateList::class)->name('application.candidate.list');
    Route::get('/ofertas-candidato', JobsListCandidate::class)->name('jobs.list.candidate');
    Route::post('/application-job', [ApplicationJobController::class, 'store'])->name('application-job.store');
    Route::delete('/application-job/{id}', [ApplicationJobController::class, 'destroy'])->name('application-job.destroy');
});
