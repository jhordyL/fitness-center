<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\AccessController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/access/scan', [AccessController::class, 'scan'])->name('access.scan');
    Route::post('/access/validate', [AccessController::class, 'validateQr'])->name('access.validate');
    Route::get('/clients/{client}/qr', [QrCodeController::class, 'show'])->name('clients.qr.show');
    Route::post('/clients/{client}/qr/generate', [QrCodeController::class, 'generate'])->name('clients.qr.generate');
    Route::post('/clients/{client}/qr/regenerate', [QrCodeController::class, 'regenerate'])->name('clients.qr.regenerate');
    Route::resource('plans', PlanController::class)->except(['show']);
    Route::resource('clients', ClientController::class)->except(['show']);
    Route::resource('memberships', MembershipController::class)->except(['show']);
    Route::resource('qr-codes', QrCodeController::class)->except(['show']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('access', AccessController::class)->except(['show']);
});

require __DIR__.'/auth.php';
