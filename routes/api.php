<?php

use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\MedicoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::post('/medico', [MedicoController::class, 'salvar']);
    Route::put('/medico', [MedicoController::class, 'atualizar']);
    Route::delete('/medico/{id}', [MedicoController::class, 'excluir']);
    Route::get('/medicos/{limite?}', function (int $limite = 10) {
        return MedicoController::select($limite);
    });
    Route::get('/medico/{id}', function (int $id) {
        return MedicoController::selectById($id);
    });


    Route::post('/especialidade', [EspecialidadeController::class, 'salvar']);
    Route::put('/especialidade', [EspecialidadeController::class, 'atualizar']);
    Route::delete('/especialidade/{id}', [EspecialidadeController::class, 'excluir']);
    Route::get('/especialidades/{limite?}', function (int $limite = 10) {
        return EspecialidadeController::select($limite);
    });
    Route::get('/especialidade/{id}', function (int $id) {
        return EspecialidadeController::selectById($id);
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
