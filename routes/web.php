<?php

use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\BackgroundImageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contact', function () {
return Inertia::render('contact/index');
})->name('contact');

// Public services route
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/about', [HistoryController::class, 'index'])->name('about');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::post('/contact', [ContactController::class, 'store']);

Route::get('/admin', function () {
return Inertia::render('Admin');
})->middleware(['auth', 'verified'])->name('admin');

// Admin routes for History management
Route::middleware(['auth', 'admin', 'verified'])->prefix('admin')->group(function () {
    Route::get('/contact-messages', [ContactMessageController::class, 'index'])
        ->name('admin.contact-messages')
        ->middleware('auth');
    Route::get('/history', [HistoryController::class, 'adminIndex'])->name('admin.history.index');
    Route::get('/history/create', [HistoryController::class, 'create'])->name('admin.history.create');
    Route::post('/history', [HistoryController::class, 'store'])->name('admin.history.store');
    Route::get('/history/{history}/edit', [HistoryController::class, 'edit'])->name('admin.history.edit');
    Route::put('/history/{history}', [HistoryController::class, 'update'])->name('admin.history.update');
    Route::delete('history/{history}', [HistoryController::class, 'destroy'])->name('admin.history.destroy');
    Route::get('/services/admin', [ServiceController::class, 'adminIndex'])->name('admin.services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/news', [NewsController::class, 'adminIndex'])->name('admin.news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('admin.news.destroy');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
