<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});

// Authenticated user routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role == 0) {
            return redirect()->route('admin');
        } else {
            return redirect()->route('services');
        }
    })->middleware(['auth'])->name('dashboard');
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Services routes
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/services/{service}', [ServiceController::class, 'showForm'])->name('services.showForm');
    Route::get('/services/{service}/payment', [PaymentController::class, 'showPaymentForm'])->name('services.payment');

    // Payment routes
    Route::post('/payments/{service}', [PaymentController::class, 'pay'])->name('payments.pay');
    Route::get('/payment/{payment}/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/{payment}/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

    // Document routes
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
    Route::get('/documents/get', [DocumentController::class, 'getDocuments'])->name('documents.get');
    Route::get('/documents/download/{path}', [DocumentController::class, 'download'])->where('path', '.*');

    //Invoices
    Route::get('/invoices/{id}', [InvoiceController::class, 'show']);

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    //Property 
    Route::get('/property',[PropertyController::class, 'index'])->name('properties');

    //About Routes
    Route::get('/about', function () {
        return view('about');
    })->name('about');

});


//documents
Route::get('/view/{path}', function ($path) {
    $file = storage_path('app/public/' . $path);

    if (!file_exists($file)) {
        abort(404);
    }

    return response()->file($file); // will display in browser
})->where('path', '.*')->name('documents.view');

// Auth routes
require __DIR__ . '/auth.php';