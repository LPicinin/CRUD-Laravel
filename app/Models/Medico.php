<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Medico extends Model
{
    //use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'MEDICOS';
    public $timestamps = false;
    protected $connection = 'mysql';

    public static function listar(int $limite)
    {
        $sql = self::select([
            "id",
            "nome",
            "CRM",
            "telefone",
            "email",
            "dt_cadastro"
        ])->limit($limite);

        return $sql->get();
    }

    public static function selectById(int $id)
    {
        $medico = Medico::find($id);
        $medico->especialidades; //comentar caso não deseje que as especialidades sejam retornadas
        return $medico;
        //return self::where('id', $id)->first();
    }

    public static function salvar(Request $request)
    {
        DB::beginTransaction();
        try {
            $med = new Medico();
            $med->nome = $request->input('nome');
            $med->CRM = $request->input('CRM');
            $med->telefone = $request->input('telefone');
            $med->email = $request->input('email');
            $med->dt_cadastro = new Carbon();
            $med->save();
            $med->especialidades()->sync($request->input('especialidades'));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
        return true;
    }

    public static function atualizar(Request $request): int
    {
        $medico = self::selectById($request->input('id'));

        if (!$medico)
            return false;
        DB::beginTransaction();
        try {
            $medico->nome = $request->input('nome');
            $medico->CRM = $request->input('CRM');
            $medico->telefone = $request->input('telefone');
            $medico->email = $request->input('email');
            $medico->dt_cadastro = new Carbon();
            $medico->save();
            $medico->especialidades()->sync($request->input('especialidades'));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
        return true;
    }

    public static function excluir(int $id): int
    {
        $medico = self::selectById($id);
        if ($medico)
            return $medico->delete();
        return true;
    }

    public function especialidades()
    {
        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
        return $this->belongsToMany(
            Especialidade::class,
            'MEDICOS_ESPECIALIDADES',
            'medico_id',
            'especialidade_id'
        );
    }
}
