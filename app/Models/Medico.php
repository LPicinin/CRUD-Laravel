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
            "CRM",
            "telefone",
            "email",
            "dt_cadastro"
        ])->limit($limite);

        return $sql->get();
    }

    public static function selectById(int $id)
    {
        return 0;
        return self::where('id', $id)->first();
    }

    public static function salvar(Request $request)
    {
        $flag = true;
        DB::beginTransaction();
        try {
            $med = new Medico();
            $med->nome = $request->input('nome');
            $med->CRM= $request->input('CRM');
            $med->telefone = $request->input('telefone');
            $med->email = $request->input('email');
            $med->dt_cadastro = new Carbon();
            $med->save();
            $med->especialidades()->sync($request->input('especialidades'));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return $flag;
    }

    public static function atualizar(Request $request): int
    {
        $flag = true;
        DB::beginTransaction();
        try {
            $med = new Medico();
            $med->nome = $request->input('nome');
            $med->CRM= $request->input('CRM');
            $med->telefone = $request->input('telefone');
            $med->email = $request->input('email');
            $med->dt_cadastro = new Carbon();
            $med->save();
            $med->especialidades()->sync($request->input('especialidades'));

            /*
            $flag = self::insert([
                "nome" => $request->input('nome'),
                "CRM" => $request->input('CRM'),
                "telefone" => $request->input('telefone'),
                "email" => $request->input('email'),
                "dt_cadastro" =>  new Carbon(),
            ]);
            */
            //DB::getPdo()->lastInsertId();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return $flag;
    }

    public static function excluir(int $id): int
    {
        return 0;
        $especialidade = self::selectById($id);
        if ($especialidade)
            return $especialidade->delete();
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
