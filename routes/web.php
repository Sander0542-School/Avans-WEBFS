<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Manager\MenuCategoryController;
use App\Http\Controllers\Manager\MenuCategoryDishController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::name('home.')->group(function () {
    Route::get('', [HomeController::class, 'index'])->name('index');
    Route::get('menu', [HomeController::class, 'menu'])->name('menu');
    Route::get('news', [HomeController::class, 'news'])->name('news');
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('discounts', [HomeController::class, 'discounts'])->name('discounts');
});

Route::prefix('download')->name('download.')->group(function () {
    Route::get('menu', [DownloadController::class, 'menu'])->name('menu');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('manager')->name('manager.')->group(function () {
        Route::resource('menus', MenuCategoryController::class)->except(['edit']);
        Route::resource('menus.dishes', MenuCategoryDishController::class)->except(['index', 'show']);
        Route::put('menus/{menu}/dishes/{dish}/restore', [MenuCategoryDishController::class, 'restore'])->name('menus.dishes.restore');
    });

    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

