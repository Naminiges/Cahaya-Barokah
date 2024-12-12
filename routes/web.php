<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WarrantyController;
use App\Http\Controllers\ServiceTransactionController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/servis', function () {
        return view('servis');
    })->name('servis');
});

Route::get('/dashboard', function () {
    if (auth()->user()->usertype == 'admin') {
        return view('admin.dashboard');
    } else {
        return view('dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     Route::resource('customers', CustomerController::class);
//     Route::resource('users', UserController::class);
//     Route::resource('services', ServiceController::class);
//     Route::resource('service_transactions', ServiceTransactionController::class);
//     Route::get('service_transactions/{transaction}/pay', [ServiceTransactionController::class, 'showPayForm'])->name('service_transactions.pay');
//     Route::post('service_transactions/{transaction}/pay', [ServiceTransactionController::class, 'processPayment'])->name('service_transactions.processPayment');
//     Route::get('service_transactions/view/{transaction}', [ServiceTransactionController::class, 'show'])->name('service_transactions.show');
//     Route::get('service_transactions/print/{transaction}', [ServiceTransactionController::class, 'print'])->name('service_transactions.print');
// });

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('customers', CustomerController::class);
    Route::resource('users', UserController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('warranties', WarrantyController::class);
    Route::resource('service_transactions', ServiceTransactionController::class);
    Route::get('service_transactions/getLaptopDetails/{laptopId}', [ServiceTransactionController::class, 'getLaptopDetails']);
    Route::get('service_transactions/{transaction}/pay', [ServiceTransactionController::class, 'showPayForm'])->name('service_transactions.pay');
    Route::post('service_transactions/{transaction}/pay', [ServiceTransactionController::class, 'processPayment'])->name('service_transactions.processPayment');
    Route::get('service_transactions/view/{transaction}', [ServiceTransactionController::class, 'show'])->name('service_transactions.show');
    Route::get('service_transactions/print/{transaction}', [ServiceTransactionController::class, 'print'])->name('service_transactions.print');
});

require __DIR__.'/auth.php';
