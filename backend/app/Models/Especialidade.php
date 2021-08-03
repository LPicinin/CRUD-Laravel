<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Especialidade extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ESPECIALIDADES';
    public $timestamps = false;
    protected $connection = 'mysql';

    public static function listar(Request $request, int $limite)
    {
        $nome = $request->query('nome');
        $sql = self::select([
            "id",
            "nome",
            "descricao"
        ]);
        if($nome)
            $sql->where('nome', 'like', '%'.$nome.'%');
        if($limite != 0)
            $sql = $sql->limit($limite);

        return $sql->get();
    }

    public static function selectById(int $id)
    {
        return self::where('id', $id)->first();
    }

    public static function salvar(Request $request): int
    {
        return self::insert([
            "nome" => $request->input('nome'),
            "descricao" => $request->input('descricao')
        ]);
    }

    public static function atualizar(Request $request): int
    {
        $especialidade = self::selectById($request->input('id'));
        if ($especialidade) {
            $especialidade->nome = $request->input('nome');
            $especialidade->descricao = $request->input('descricao');
            return $especialidade->save();
        }
        return false;
    }

    public static function excluir(int $id): int
    {
        $especialidade = self::selectById($id);
        if ($especialidade)
            return $especialidade->delete();
        return true;
    }


    public function medicos()
    {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(
            Medico::class,
            'MEDICOS_ESPECIALIDADES',
            'especialidade_id',
            'medico_id'
        );
    }
}
