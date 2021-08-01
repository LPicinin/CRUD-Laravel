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

    public static function salvar(Request $request)
    {
        if (Especialidade::salvar($request))
            return response("ok", 201);
        else
            return  response("erro", 409);
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
