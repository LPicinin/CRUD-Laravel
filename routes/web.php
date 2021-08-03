<?php

use App\Http\Controllers\EspecialidadeController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/medico', function () {
    return view('medico');
});

//Route::get('/especialidade', 'EspecialidadeController@index');
Route::get('/especialidade', function ()
{
    return EspecialidadeController::index();
});

Route::post('/especialidade/salvar', 'EspecialidadeController@salvar')->name('salvarEspecialidade');
