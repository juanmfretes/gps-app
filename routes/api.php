<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizacionController;
use App\Http\Controllers\NotificacionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Ruta para insertar nuevas localizaciones
Route::post('/insertarLocalizacion', [LocalizacionController::class, 'store']);

// Ruta para insertar nuevas notificaciones
Route::post('/insertarNotificacion', [NotificacionController::class, 'store']);

// =============================================================
// MAPAS
// =============================================================

// Obtener la última localización añadida a la DB
Route::get('/location/lastLocations', [LocalizacionController::class, 'getLastLocation']);

// Obtener las notificaciones de un vehículo específico
Route::get('/notification/{vehicle_id}', [NotificacionController::class, 'getAllNotifications']);
