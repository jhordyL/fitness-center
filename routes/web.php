<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas protegidas por autenticación
|--------------------------------------------------------------------------
| Todo usuario que ingrese aquí debe haber iniciado sesión.
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Rutas administrativas
    |--------------------------------------------------------------------------
    | Solo el administrador puede gestionar planes, clientes, membresías
    | y códigos QR de clientes.
    */
    Route::middleware('role:admin')->group(function () {
        Route::resource('plans', PlanController::class)->except(['show']);
        Route::resource('clients', ClientController::class)->except(['show']);
        Route::resource('memberships', MembershipController::class)->except(['show']);

        Route::get('/clients/{client}/qr', [QrCodeController::class, 'show'])
            ->name('clients.qr.show');

        Route::post('/clients/{client}/qr/generate', [QrCodeController::class, 'generate'])
            ->name('clients.qr.generate');

        Route::post('/clients/{client}/qr/regenerate', [QrCodeController::class, 'regenerate'])
            ->name('clients.qr.regenerate');
    });

    /*
    |--------------------------------------------------------------------------
    | Rutas de validación de acceso
    |--------------------------------------------------------------------------
    | Administrador y recepción pueden validar accesos por QR.
    */
    Route::get('/access/scan', [AccessController::class, 'scan'])
        ->name('access.scan');

    Route::post('/access/validate', [AccessController::class, 'validateQr'])
        ->name('access.validate');

    /*
    |--------------------------------------------------------------------------
    | Perfil de usuario
    |--------------------------------------------------------------------------
    | Rutas propias de Laravel Breeze.
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
