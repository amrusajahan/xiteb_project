<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.show');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// General dashboard index will route users to their role-specific dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Explicit named dashboard routes (protected)
Route::get('/dashboard/user', [DashboardController::class, 'index'])->name('dashboard.user')->middleware('auth');
Route::get('/dashboard/pharmacy', [DashboardController::class, 'index'])->name('dashboard.pharmacy')->middleware('auth');

// Prescription upload for normal users
Route::get('/prescriptions/create', [\App\Http\Controllers\PrescriptionController::class, 'create'])->name('prescriptions.create')->middleware('auth');
Route::post('/prescriptions', [\App\Http\Controllers\PrescriptionController::class, 'store'])->name('prescriptions.store')->middleware('auth');

// Pharmacy: view prescriptions and create quotations
Route::get('/pharmacy/prescriptions', [\App\Http\Controllers\QuotationController::class, 'prescriptions'])->name('pharmacy.prescriptions')->middleware('auth');
Route::get('/pharmacy/prescriptions/{id}', [\App\Http\Controllers\QuotationController::class, 'showPrescription'])->name('pharmacy.prescriptions.show')->middleware('auth');
Route::post('/pharmacy/prescriptions/{id}/quotations', [\App\Http\Controllers\QuotationController::class, 'storeQuotation'])->name('pharmacy.quotations.store')->middleware('auth');
Route::get('/pharmacy/quotations', [\App\Http\Controllers\QuotationController::class, 'pharmacyQuotations'])->name('pharmacy.quotations')->middleware('auth');
Route::get('/pharmacy/quotations/create/{prescription}', [\App\Http\Controllers\QuotationController::class, 'createQuotation'])->name('pharmacy.quotations.create')->middleware('auth');
Route::get('/pharmacy/quotations/{id}', [\App\Http\Controllers\QuotationController::class, 'showQuotation'])->name('pharmacy.quotations.show')->middleware('auth');

// User: view and respond to quotations
Route::get('/my-quotations', [\App\Http\Controllers\QuotationController::class, 'userQuotations'])->name('user.quotations')->middleware('auth');
Route::post('/quotations/{id}/respond', [\App\Http\Controllers\QuotationController::class, 'respondQuotation'])->name('user.quotations.respond')->middleware('auth');