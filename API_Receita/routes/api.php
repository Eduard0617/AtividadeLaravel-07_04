<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\ReceitasController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ROTAS INGREDIENTES

Route::get('/ingredientes', [IngredienteController::class, 'index']);

Route::get('/ingredientes/{ingrediente}', [IngredienteController::class, 'show']);

Route::post('/ingredientes', [IngredienteController::class, 'store']);

Route::put('/ingredientes/{ingrediente}', [IngredienteController::class, 'update']);

Route::delete('/ingredientes/{ingrediente}', [IngredienteController::class, 'destroy']);


// ROTAS RECEITAS

Route::get('/receitas', [ReceitasController::class, 'index']);

Route::get('/receitas/{receitas}', [ReceitasController::class, 'show']);

Route::post('/receitas', [ReceitasController::class, 'store']);

Route::put('/receitas/{receitas}', [ReceitasController::class, 'update']);

Route::delete('/receitas/{receitas}', [ReceitasController::class, 'destroy']);
