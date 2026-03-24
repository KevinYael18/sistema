<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;


Route::resource('usuarios', UsuarioController::class);

Route::get('/', function () {
    return view('welcome');
});
