<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class IngredienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredientes = Ingrediente::all();
        return response()->json($ingredientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'quantidade' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $ingrediente = Ingrediente::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Ingrediente cadastrado com sucesso!',
            'data' => $ingrediente
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingrediente $ingrediente)
    {
        return response()->json($ingrediente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingrediente $ingrediente)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'quantidade' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $ingrediente->nome = $request->nome;
        $ingrediente->quantidade = $request->quantidade;

        if ($ingrediente->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Ingrediente atualizado com sucesso!',
                'data' => $ingrediente
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao atualizar o ingrediente'
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingrediente $ingrediente)
    {
        if ($ingrediente->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Ingrediente deletado com sucesso'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar o ingrediente'
        ], 500);
    }
}
