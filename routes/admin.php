<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // RUTAS DEL MODULO USUARIOS
    Route::controller(UsuarioController::class)->group(function () {
        Route::get('/usuarios', 'index')->name('usuarios.index');
        Route::get('/usuarios/create', 'create')->name('usuarios.create');
        Route::get('/usuarios/asignar-rol-a-usuarios', 'asignarRolAUsuario')->name('usuarios.asignar-rol-a-usuarios');
        Route::get('/usuarios/cambiar-contrasena', 'cambiarContrasenha')->name('usuarios.cambiar-contrasenha');
        Route::get('/usuarios/{usuario}/edit', 'edit')->name('usuarios.edit');
        Route::get('/usuarios/{usuario}/asignar-rol', 'asignarRol')->name('usuarios.asignar-rol'); // AGREGAR MIDDLEWARE PARA EVITAR QUE MANIPULEN LA URL Y ACCEDAN AL USUARIO ADMINISTRADOR
    });

    // RUTAS DEL MODULO ROLES
    Route::controller(RoleController::class)->group(function () {
        Route::get('/roles', 'index')->name('roles.index');
        Route::get('/roles/create', 'create')->name('roles.create');
        Route::get('/roles/{role}/edit', 'edit')->name('roles.edit');
    });
});
