<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Models\ActivityLog;
use App\Http\Controllers\CarritoController;

Route::middleware('auth')->group(function () {
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/{producto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::patch('/carrito/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
    Route::delete('/carrito/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::delete('/carrito', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
});

Route::post('/reportes/csv', [ProductoController::class, 'exportarCsv'])
    ->middleware('auth')
    ->name('reportes.csv');
    
Route::get('/actividad', function () {
    $logs = ActivityLog::with('user')->latest()->take(50)->get();
    return view('actividad.index', compact('logs'));
})->middleware(['auth','checkRol:admin'])->name('actividad.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/reportes/pdf', [ProductoController::class, 'exportPdf'])->name('reportes.pdf');
    Route::get('/reportes/excel', [ProductoController::class, 'exportExcel'])->name('reportes.excel');
});

Route::middleware(['auth','verified'])->group(function () {
    Route::resource('productos', ProductoController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->get('/notificaciones', function () {
    $notificaciones = auth()->user()->notifications()->paginate(5);
    return view('notificaciones.index', compact('notificaciones'));
})->name('notificaciones');

require __DIR__.'/auth.php';