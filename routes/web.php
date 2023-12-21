<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StaticLocationController;
use App\Http\Controllers\ProfileController;

Route::middleware(['logged'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('app.index');
    Route::get('/registrarme', [LoginController::class, 'register'])->name('app.register');
    Route::post('/codigo', [LoginController::class, 'code'])->name('app.code');
    Route::post('/iniciar-sesion', [LoginController::class, 'login'])->name('app.login');
    Route::post('/nuevo-usuario', [LoginController::class, 'store'])->name('app.store');

    Route::get('/restaurar-clave', [LoginController::class, 'reset'])->name('reset.password.index');
    Route::post('/restaurar-clave', [LoginController::class, 'resetPassword'])->name('reset.password.store');
});




Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', [HomeController::class, 'index'])->name('home.index');

    Route::post('/mi-ubicacion', [LocationController::class, 'store'])->name('location.store');

    Route::get('/mis-direcciones', [StaticLocationController::class, 'index'])->name('static.location.index');
    Route::post('/guardar-direccion', [StaticLocationController::class, 'store'])->name('static.location.store');
    Route::put('/editar-mi-direccion', [StaticLocationController::class, 'update'])->name('static.location.update');
    Route::delete('/eliminar-mi-ubicacion', [StaticLocationController::class, 'delete'])->name('static.location.delete');
    Route::get('/editar-direccion/{id}', [StaticLocationController::class, 'edit'])->name('static.location.edit');

    Route::get('/mi-perfil', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/mi-perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/cambiar-clave', [ProfileController::class, 'change'])->name('profile.reset.password');
    Route::post('/cambiar-clave', [ProfileController::class, 'changePassword'])->name('profile.password.store');









    Route::get('/logout', [LoginController::class, 'logout'])->name('app.logout');
});
