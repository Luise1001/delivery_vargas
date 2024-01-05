<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StaticLocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommerceController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;

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

    Route::get('/comprar', [BuyController::class, 'index'])->name('buy.index');
    Route::get('/comprar/categoria={categoria}/id={id}', [BuyController::class, 'commerce'])->name('buy.commerce.list');
    Route::get('/productos/comercio={comercio}/id{id}', [BuyController::class, 'products'])->name('buy.products.list');


    Route::get('/mi-perfil', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/mi-perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/cambiar-clave', [ProfileController::class, 'change'])->name('profile.reset.password');
    Route::post('/cambiar-clave', [ProfileController::class, 'changePassword'])->name('profile.password.store');

    Route::get('/lista-de-usuarios', [UserController::class, 'index'])->name('user.list.index');
    Route::put('/editar-usuario', [UserController::class, 'update'])->name('user.list.update');
    Route::get('/editar-usuario/id={id}', [UserController::class, 'edit'])->name('user.list.edit');


    Route::get('/lista-de-comercios', [CommerceController::class, 'index'])->name('commerce.list.index');
    Route::get('/mi-comercio', [CommerceController::class, 'myCommerce'])->name('commerce.myCommerce');
    Route::put('/mi-comercio', [CommerceController::class, 'update'])->name('commerce.myCommerce.update');
    
    Route::get('/lista-de-conductores', [DriverController::class, 'index'])->name('driver.list.index');
    Route::get('/editar-conductor/id={id}', [DriverController::class, 'edit'])->name('driver.list.edit');
    Route::put('/editar-conductor', [DriverController::class, 'update'])->name('driver.list.update');

    Route::get('/lista-de-motos', [MotorcycleController::class, 'index'])->name('motorcycle.list.index');
    Route::get('/nueva-moto', [MotorcycleController::class, 'create'])->name('motorcycle.list.create');
    Route::post('/nueva-moto', [MotorcycleController::class, 'store'])->name('motorcycle.list.store');
    Route::get('/editar-moto/id={id}', [MotorcycleController::class, 'edit'])->name('motorcycle.list.edit');
    Route::put('/editar-moto', [MotorcycleController::class, 'update'])->name('motorcycle.list.update');
    Route::delete('/eliminar-moto', [MotorcycleController::class, 'delete'])->name('motorcycle.list.delete');

    Route::get('/tarifas', [FeeController::class, 'index'])->name('fee.index');	
    Route::get('/nueva-tarifa', [FeeController::class, 'create'])->name('fee.create');
    Route::post('/nueva-tarifa', [FeeController::class, 'store'])->name('fee.store');
    Route::get('/editar-tarifa/id={id}', [FeeController::class, 'edit'])->name('fee.edit');
    Route::put('/editar-tarifa', [FeeController::class, 'update'])->name('fee.update');
    Route::delete('/eliminar-tarifa', [FeeController::class, 'delete'])->name('fee.delete');


    Route::get('/datos-bancarios', [BankController::class, 'index'])->name('data.bank.index');
    Route::get('/nuevo-dato-bancario', [BankController::class, 'create'])->name('data.bank.create');
    Route::post('/nuevo-dato-bancario', [BankController::class, 'store'])->name('data.bank.store');
    Route::get('/editar-dato-bancario/{type}/{id}', [BankController::class, 'edit'])->name('data.bank.edit');
    Route::put('/editar-dato-bancario', [BankController::class, 'update'])->name('data.bank.update');
    Route::delete('/eliminar-dato-bancario', [BankController::class, 'delete'])->name('data.bank.delete');

    Route::get('/categorias', [CategoryController::class, 'index'])->name('commerce.category.index');
    Route::put('/categorias', [CategoryController::class, 'update'])->name('commerce.category.update');

    Route::get('/horarios', [ScheduleController::class, 'index'])->name('commerce.schedule.index');
    Route::put('/horarios', [ScheduleController::class, 'update'])->name('commerce.schedule.update');

    Route::get('/metodos-de-pago', [PaymentMethodController::class, 'index'])->name('commerce.payment.method.index');
    Route::put('/metodos-de-pago', [PaymentMethodController::class, 'update'])->name('commerce.payment.method.update');

    Route::get('/productos', [ProductController::class, 'index'])->name('commerce.product.index');
    Route::get('/nuevo-producto', [ProductController::class, 'create'])->name('commerce.product.create');
    Route::post('/nuevo-producto', [ProductController::class, 'store'])->name('commerce.product.store');
    Route::get('/editar-producto/{id}', [ProductController::class, 'edit'])->name('commerce.product.edit');
    Route::put('/editar-producto', [ProductController::class, 'update'])->name('commerce.product.update');
    Route::delete('/eliminar-producto', [ProductController::class, 'delete'])->name('commerce.product.delete');









    Route::get('/logout', [LoginController::class, 'logout'])->name('app.logout');
});
