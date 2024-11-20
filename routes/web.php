<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ProjectController;
use App\Http\Middleware\CheckUserRole;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/project.index',[ProjectController::class, 'index'])->name('project.index');

Route::middleware(['checkUserRole:user,manager'])->group(function () {
    Route::get('/project/showToOwner/{id}', [ProjectController::class, 'showToOwner'])->name('project.showToOwner');
});

Route::middleware(['checkUserRole:manager,developer, lead_developer'])->group(function () {
    Route::get('/project/show/{id}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/progress/show/{id}', [ProgressController::class, 'show'])->name('progress.show');
});

Route::middleware(['checkUserRole:user'])->group(function () {
    Route::get('/project/create',[ProjectController::class, 'create'])->name('project.create');
    Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store');
    });

Route::middleware(['checkUserRole:manager'])->group(function () {
    //Route::get('/project/show/{id}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/project.acceptance',[ProjectController::class, 'acceptance'])->name('project.acceptance');
    Route::get('/project.acceptProject/{id}',[ProjectController::class, 'acceptProject'])->name('project.acceptProject');
    Route::get('/project.rejectProject/{id}',[ProjectController::class, 'rejectProject'])->name('project.rejectProject');
    Route::get('/project/assignmentPage/{id}', [ProjectController::class, 'assignmentPage'])->name('project.assignmentPage');
    Route::post('/project/assignProject/{id}', [ProjectController::class, 'assignProject'])->name('project.assignProject');
    Route::get('/project/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::post('/project/update/{id}', [ProjectController::class, 'update'])->name('project.update');
    //Route::get('/progress/show/{id}', [ProgressController::class, 'show'])->name('progress.show');
});

Route::middleware(['checkUserRole:lead_developer'])->group(function () {
    //Route::get('/project/show/{id}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/progress/create/{id}', [ProgressController::class, 'create'])->name('progress.create');
    Route::post('/progress/store/{id}', [ProgressController::class, 'store'])->name('progress.store');
    //Route::get('/progress/show/{id}', [ProgressController::class, 'show'])->name('progress.show');
});

Route::middleware(['checkUserRole:developer'])->group(function () {
    //Route::get('/project/show/{id}', [ProjectController::class, 'show'])->name('project.show');
    //Route::get('/progress/show/{id}', [ProgressController::class, 'show'])->name('progress.show');
});
