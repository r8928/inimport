<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceImportController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::view('/upload', 'upload')->name('home');
    Route::post('/upload', InvoiceImportController::class);

    Route::prefix('invoice')->controller(InvoiceController::class)->group(function () {
        Route::get('', 'index')->name('invoice.list');
        Route::get('{invoice_no}', 'show')->name('invoice.show');
        Route::get('send/{invoice_no}', 'send')->name('invoice.send');
    });

    Route::prefix('config')->controller(ConfigController::class)->group(function () {
        Route::get('', 'index')->name('config.index');
        Route::post('', 'store');
        Route::post('super', 'storesuper')->name('config.super');
    });
});

Route::fallback(function () {
    return redirect()->route('login');
});
