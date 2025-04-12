<?php

namespace App\Http\Controllers;

use App\Models\Livros;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LivrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livros = Livros::all();
        return response()->json($livros);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'autor' => 'required',
            'numPaginas' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $livros = Livros::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Livro cadastrado com sucesso!',
            'data' => $livros
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Livros $livro)
    {
        return response()->json($livro);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Livros $livro)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'autor' => 'required',
            'numPaginas' => 'required|numeric'
        ]);
    
        // Verifica se a validação falhou
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 400);
        }
    
        // Atualizando os dados do livro
        $livro->titulo = $request->titulo;
        $livro->autor = $request->autor;
        $livro->numPaginas = $request->numPaginas;
    
        // Tentando salvar as alterações
        if ($livro->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Livro atualizado com sucesso!',
                'data' => $livro
            ], 200);
        }
    
        // Caso ocorra algum erro ao salvar
        return response()->json([
            'success' => false,
            'message' => 'Erro ao atualizar o livro'
        ], 500);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livros $livro)
    {
        if ($livro->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'livro deletado com sucesso'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar o livro'
        ], 500);
    }
}
