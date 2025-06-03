<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DocumentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public landing page
Route::get('/', function () {
    return view('dokumen');
});

// Authenticated user routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Stripe Cashier product checkout test
    Route::get('/product-checkout', function (Request $request) {
        return $request->user()->checkout([
            'price_1RSwLvEQkRdPgJrgUwF2bKTb' => 1 // Make sure this is a valid Stripe Price ID
        ]);
    });

    // Services routes
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/services/{service}', [ServiceController::class, 'showForm'])->name('services.showForm');
    Route::get('/services/{service}/payment', [PaymentController::class, 'showPaymentForm'])->name('services.payment');

    // Payment routes
    Route::post('/payments/{service}', [PaymentController::class, 'pay'])->name('payments.pay');
    Route::get('/payment/{payment}/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/{payment}/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

// Auth routes
require __DIR__ . '/auth.php';


Route::get('/', [DocumentController::class, 'index'])->name('documents');
Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
Route::get('/documents/search', [DocumentController::class, 'search'])->name('documents.search');
Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');

// Admin routes (you might want to add middleware for authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/admin/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::delete('/admin/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
});

