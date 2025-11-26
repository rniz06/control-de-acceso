<?php

use App\Http\Controllers\Cda\ControlDeAccesoController;
use App\Http\Controllers\Cda\PanelCentralController;
use App\Http\Controllers\Cda\Parametros\ColorController;
use App\Http\Controllers\Cda\Parametros\MarcaController;
use App\Http\Controllers\Cda\Parametros\VehiculoController;
use App\Http\Controllers\Cda\ReporteController;
use App\Http\Controllers\Compras\Pedidos\PedidoController;
use App\Http\Controllers\Compras\Proveedores\ProveedorController;
use Illuminate\Support\Facades\Route;


// RUTAS DEL MODULO CONTROL DE ACCESO


Route::prefix('control-de-acceso')->name('cda.')->middleware('auth')->group(function () {

    // RUTAS DEL MODULO PANEL CENTRAL
    Route::controller(PanelCentralController::class)->prefix('panel-central')->name('panel-central.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    // RUTAS DEL MODULO CONTROL DE ACCESO / INGRESO VEHICULO
    Route::controller(ControlDeAccesoController::class)->prefix('ingreso-vehiculo')->name('ingreso-vehiculo.')->group(function () {
        Route::get('/', 'ingresoVehiculo')->name('ingreso');
        Route::get('/salida', 'salidaVehiculo')->name('salida');
    });

    // RUTAS DEL MODULO CONTROL DE ACCESO / INGRESO PERSONA
    Route::controller(ControlDeAccesoController::class)->prefix('ingreso-persona')->name('ingreso-persona.')->group(function () {
        Route::get('/', 'ingresoPersona')->name('ingreso');
        Route::get('/salida', 'salidaPersona')->name('salida');
    });

    // RUTAS DEL MODULO CONTROL DE ACCESO / REPORTES / INGRESO
    Route::controller(ReporteController::class)->prefix('reportes')->name('reportes.')->group(function () {
        Route::get('/', 'ingreso')->name('ingreso');
    });

    # RUTAS DE AGRUPADAS DE PARAMETROS
    Route::prefix('parametros')->name('parametros.')->group(function () {

        # RUTAS DEL MODULO PARAMETROS / VEHICULOS
        Route::controller(VehiculoController::class)->prefix('vehiculos')->name('vehiculos.')->group(function () {
            Route::get('/', 'index')->name('index');
        });

        # RUTAS DEL MODULO PARAMETROS / MARCAS
        Route::controller(MarcaController::class)->prefix('marcas')->name('marcas.')->group(function () {
            Route::get('/', 'index')->name('index');
        });

        # RUTAS DEL MODULO PARAMETROS / COLORES
        Route::controller(ColorController::class)->prefix('colores')->name('colores.')->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });
});
