<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Especialidade;
use Illuminate\Http\Request;

class EspecialidadeController extends Controller
{
    public static function select(int $limite)
    {
        return Especialidade::listar($limite);
    }

    public static function selectById(int $id)
    {
        return Especialidade::selectById($id);
    }

    public static function index()
    {
        $lista = Especialidade::listar(100);
        return view('especialidade.cadastro', [
            "list" => $lista
        ]);
    }

    public static function salvar(Request $request)
    {

        $request->validate([
            "nome" => "required",
            "descricao" => "required",
        ]);

        $lista = Especialidade::listar(100);

        if (Especialidade::cadastrar($request))
            return view('especialidade.cadastrar', [
                "sucesso" => $request->input('nome') + " cadastrado com sucesso",
                "especialidades" => $lista
            ]);
        else
            echo "Ops! Falhou ao cadastrar!";
    }

    public static function atualizar(Request $request)
    {
        if (Especialidade::atualizar($request))
            return response("ok", 200);
        else
            return  response("Erro: a Especialidade não pode ser encontrada", 409);
    }

    public static function excluir(int $id)
    {
        if (Especialidade::excluir($id))
            return response("ok", 200);
        else
            return  response("erro", 404);
    }
}
