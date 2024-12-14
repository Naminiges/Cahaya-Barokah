<?php
use App\Http\Controllers\BuyingController;
use App\Http\Controllers\SupplierController;
use App\Models\Buying;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceTransactionController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('admin/dashboard', [HomeController::class, 'index']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('customers', CustomerController::class);
    Route::resource('users', UserController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('service_transactions', ServiceTransactionController::class);
    // Route::resource('buying', BuyingController::class);
    Route::get('service_transactions/{transaction}/pay', [ServiceTransactionController::class, 'showPayForm'])->name('service_transactions.pay');
    Route::post('service_transactions/{transaction}/pay', [ServiceTransactionController::class, 'processPayment'])->name('service_transactions.processPayment');
    Route::get('service_transactions/view/{transaction}', [ServiceTransactionController::class, 'show'])->name('service_transactions.show');
    Route::get('service_transactions/print/{transaction}', [ServiceTransactionController::class, 'print'])->name('service_transactions.print');
    // Route::get('buying/{transaction}/pay', [BuyingController::class, 'showPayForm'])->name('buying.pay');
    // Route::post('buying/{transaction}/pay', [BuyingController::class, 'processPayment'])->name('buying.processPayment');
    // Route::get('buying/view/{transaction}', [BuyingController::class, 'show'])->name('buying.show');
    // Route::get('buying/print/{transaction}', [BuyingController::class, 'print'])->name('buying.print');
});

require __DIR__.'/auth.php';
