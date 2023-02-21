<?php

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

Route::view('/', 'welcome')->name('home');
Route::post('/', InvoiceImportController::class);
Route::get('list', [InvoiceController::class, 'index'])->name('invoice.list');
Route::get('list/{invoice_no}', [InvoiceController::class, 'show'])->name('invoice.show');
Route::get('list/send/{invoice_no}', [InvoiceController::class, 'send'])->name('invoice.send');
