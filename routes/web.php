<?php

use App\Http\Controllers\BackgroundImageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/services', function () {
    return Inertia::render('Services');
})->name('services');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Manual CRUD routes for Projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

// Manual CRUD routes for Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');
Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

// CRUD routes for Background Images (commented out as per your code)
//Route::middleware(['auth', 'verified'])->group(function () {
//    Route::get('/background-images', [BackgroundImageController::class, 'index'])->name('background-images.index');
//    Route::get('/background-images/create', [BackgroundImageController::class, 'create'])->name('background-images.create');
//    Route::post('/background-images', [BackgroundImageController::class, 'store'])->name('background-images.store');
//    Route::get('/background-images/{backgroundImage}/edit', [BackgroundImageController::class, 'edit'])->name('background-images.edit');
//    Route::put('/background-images/{backgroundImage}', [BackgroundImageController::class, 'update'])->name('background-images.update');
//    Route::delete('/background-images/{backgroundImage}', [BackgroundImageController::class, 'destroy'])->name('background-images.delete');
//});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
