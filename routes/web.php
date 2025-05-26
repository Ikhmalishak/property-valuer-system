<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public landing page
Route::get('/', function () {
    return view('welcome');
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
