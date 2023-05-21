<?php

//All Controller Path...
use App\Http\Controllers\backend\ProjectController;
use App\Http\Controllers\backend\TaskListController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Welcomecontroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NumberVerifyController;




// All routes list here....
Auth::routes();
Route::get('/', [Welcomecontroller::class, 'index'])->name('welcome');


Route::get('/dashboard', [HomeController::class, 'index'])->name('home');


//Role Permission Routes Here....
Route::middleware('auth')->prefix('dashboard')->group(function () {

    Route::resource('project', ProjectController::class);

    Route::get('task-list/{id}', [TaskListController::class, 'index'])->name('task-list');
    Route::resource('task-list', TaskListController::class);
});

