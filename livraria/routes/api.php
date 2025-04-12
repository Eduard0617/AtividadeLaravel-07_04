<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivrosController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ROTAS LIVROS

Route::get('/livros', [LivrosController::class, 'index']);

Route::get('/livros/{livro}', [LivrosController::class, 'show']);

Route::post('/livros', [LivrosController::class, 'store']);

Route::put('/livros/{livro}', [LivrosController::class, 'update']);

Route::delete('/livros/{livro}', [LivrosController::class, 'destroy']);