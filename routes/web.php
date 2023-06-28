<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\VehiculoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('auth.login');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('components.dashboard')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// =============================================================
// EMPRESA [SOLO ADMIN PUEDE VER]
// =============================================================

Route::middleware('checkAdmin')->group(function () {
    // Mostrar tabla con todas las Empresas
    Route::get('/empresas', [EmpresaController::class, 'index'])->name('components.empresas.index');

    // Añadir una nueva empresa
    Route::get('/empresas/create', [EmpresaController::class, 'create'])->name('components.empresas.create');

    // Almacenar una nueva empresa
    Route::post('/empresas', [EmpresaController::class, 'store'])->name('components.empresas.store');

    // Mostrar los datos de una empresa específica
    Route::get('/empresas/{id}', [EmpresaController::class, 'show'])->name('components.empresas.show');

    // Editar los datos de una empresa
    Route::get('/empresas/{id}/edit', [EmpresaController::class, 'edit'])->name('components.empresas.edit');

    // Actualizar los datos de una empresa
    Route::put('/empresas/{id}', [EmpresaController::class, 'update'])->name('components.empresas.update');

    // Eliminar una empresa
    Route::delete('/empresas/{id}', [EmpresaController::class, 'destroy'])->name('components.empresas.destroy');
});

Route::middleware('auth')->group(function () {
    // =============================================================
    // VEHICULO
    // =============================================================

    // Mostrar tabla con todos los vehículos (ADMIN O NORMAL USER)
    Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('components.vehiculos.index');

    // Mostrar los datos de un vehículo específico (ADMIN O NORMAL USER)
    Route::get('/vehiculos/{id}', [VehiculoController::class, 'show'])->name('components.vehiculos.show');

    // Añadir un nuevo vehiculo (SOLO ADMIN)
    Route::get('/create', [VehiculoController::class, 'create'])->name('components.vehiculos.create');

    // Editar los datos de un vehiculo (ADMIN O NORMAL USER)
    Route::get('/vehiculos/{id}/edit', [VehiculoController::class, 'edit'])->name('components.vehiculos.edit');

    // Actualizar los datos de un vehiculo (ADMIN O NORMAL USER) - Normal user sólo los de SU empresa
    Route::put('/vehiculos/{id}', [VehiculoController::class, 'update'])->name('components.vehiculos.update');

    // Almacenar un nuevo vehiculo (SOLO ADMIN)
    Route::post('/vehiculos', [VehiculoController::class, 'store'])->name('components.vehiculos.store');

    // Eliminar un vehiculo (SOLO ADMIN)
    Route::delete('/vehiculos/{id}', [VehiculoController::class, 'destroy'])->name('components.vehiculos.destroy');

    // =============================================================
    // MAPAS
    // =============================================================

    // Mostrar mapa con Localizaciones
    Route::get('/mapa/localizaciones', [MapaController::class, 'localizaciones'])->name('components.mapas.localizaciones');

    // Mostrar mapa con Notificaciones
    Route::get('/mapa/notificaciones', [MapaController::class, 'notificaciones'])->name('components.mapas.notificaciones');
});
