<?php

use App\Http\Controllers\CashDeskController;
use App\Http\Controllers\HomeController;
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

Route::name('cashdesk.')->group(function () {
    Route::get('', [CashDeskController::class, 'index'])->name('index');
    Route::get('dishes', [CashDeskController::class, 'dishes'])->name('dishes');
    Route::get('news', [CashDeskController::class, 'news'])->name('news');
    Route::get('contact', [CashDeskController::class, 'contact'])->name('contact');
    Route::get('discounts', [CashDeskController::class, 'discounts'])->name('discounts');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
