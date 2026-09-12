<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\ProyectoController;


Route::middleware('auth:api')->prefix('proyectos')->group(function(){
    Route::get('/',[ProyectoController::class,'index'])

    ->middleware('role_or_permission:admin|docente|estudiante');
    Route::get('/',[ProyectoController::class,'index']);

    ->middleware('role_or_permission:admin|docente');
    Route::post('/',[ProyectoController::class,'store']);

    ->middleware('role_or_permission:admin');
    Route::post('/',[ProyectoController::class,'eliminar']);
});