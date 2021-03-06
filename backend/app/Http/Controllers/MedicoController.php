<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public static function select(int $limite)
    {
        return Medico::listar($limite);
    }

    public static function selectById(int $id)
    {
        return Medico::selectById($id);
    }

    public static function salvar(Request $request)
    {
        //return $request;
        if (Medico::salvar($request))
            return response("ok", 201);
        else
            return  response("erro", 409);
    }

    public static function atualizar(Request $request)
    {
        if (Medico::atualizar($request))
            return response("ok", 200);
        else
            return  response("Erro: a Medico não pode ser encontrada", 409);
    }

    public static function excluir(int $id)
    {
        if (Medico::excluir($id))
            return response("ok", 200);
        else
            return  response("erro", 404);
    }
}
