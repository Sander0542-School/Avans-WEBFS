<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Manager\CashDeskController;
use App\Http\Controllers\Manager\CashDeskOrdersController;
use App\Http\Controllers\Manager\MenuCategoryController;
use App\Http\Controllers\Manager\MenuCategoryDishController;
use App\Http\Controllers\Manager\SalesController;
use App\Http\Controllers\OrderController;
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

Route::prefix('order')->name('order.')->group(function () {
    Route::get('', [OrderController::class, 'index'])->name('index');
    Route::get('{category}', [OrderController::class, 'show'])->name('show');
    Route::get('confirmed/{order}/{token?}', [OrderController::class, 'confirmed'])->name('confirmed');
    Route::post('', [OrderController::class, 'store'])->name('store')->middleware(['throttle:1,10']);
});

Route::prefix('download')->name('download.')->group(function () {
    Route::get('menu', [DownloadController::class, 'menu'])->name('menu');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('manager')->name('manager.')->group(function () {
        Route::resource('menus', MenuCategoryController::class)->except(['edit']);
        Route::resource('menus.dishes', MenuCategoryDishController::class)->except(['index', 'show']);
        Route::put('menus/{menu}/dishes/{dish}/restore', [MenuCategoryDishController::class, 'restore'])->name('menus.dishes.restore');

        Route::prefix('sales')->name('sales.')->group(function () {
            Route::get('', [SalesController::class, 'index'])->name('index');
            Route::get('download/{date}', [SalesController::class, 'download'])->name('download');
        });

        Route::prefix('cashdesk')->name('cashdesk.')->group(function () {
            Route::get('', [CashDeskController::class, 'index'])->name('index');
            Route::get('dishes', [CashDeskController::class, 'dishes'])->name('dishes');
            Route::post('store', [CashDeskController::class, 'store'])->name('store');

            Route::prefix('orders')->name('orders.')->group(function () {
                Route::get('', [CashDeskOrdersController::class, 'index'])->name('index');
                Route::get('{order}', [CashDeskOrdersController::class, 'show'])->name('show');
                Route::patch('{order}/status', [CashDeskOrdersController::class, 'status'])->name('status');
            });
        });
    });

    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
