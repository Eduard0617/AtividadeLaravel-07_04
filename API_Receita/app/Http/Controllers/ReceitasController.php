<?php

namespace App\Http\Controllers;

use App\Models\Receitas;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ReceitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receitas = Receitas::all();
        return response()->json($receitas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'tempo_preparo' => 'required|integer',
            'dificuldade' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $receita = Receitas::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Receita cadastrada com sucesso!',
            'data' => $receita
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Receitas $receitas)
    {
        return response()->json($receitas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receitas $receitas)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'tempo_preparo' => 'required|integer',
            'dificuldade' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $receitas->titulo = $request->titulo;
        $receitas->tempo_preparo = $request->tempo_preparo;
        $receitas->dificuldade = $request->dificuldade;

        if ($receitas->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Receita atualizada com sucesso!',
                'data' => $receitas
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao atualizar a receita'
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receitas $receitas)
    {
        if ($receitas->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Receita deletada com sucesso'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar a receita'
        ], 500);
    }
}