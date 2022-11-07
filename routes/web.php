<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\DirectorsController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/movie/{id}/{title}', [MovieController::class, 'View'])->name('view_movie');
Route::get('/movies', [MovieController::class, 'Movies'])->name('movies');
Route::get('/movies-by/{id}/{title}', [MovieController::class, 'MoviesBy'])->name('movies_by');
Route::get('/directors', [DirectorsController::class, 'Directors'])->name('directors');
Route::get('/top-directors', [DirectorsController::class, 'TopDirectors'])->name('top_directors');

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('dashboard', [AuthController::class, 'dashboard']);
