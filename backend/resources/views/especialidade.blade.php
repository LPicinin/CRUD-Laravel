@extends('layout')
<style>
    .barraBotoes {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: center;
    }

    .barraBotoes>button {
        margin: 1rem;
        width: 6em;
    }

    .tabelaOpcoes {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .busca {
        display: flex;
        flex-direction: row;
    }

</style>
@section('content')
    <div class="container">
        <h1>Páginda Especialidade</h1>
        <div class="container">
            <div class="barraBotoes">
                <div class="busca">
                    <input type="search" id="form1" class="form-control" />
                    <button type="button" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <button class="btn btn-primary"><i class="bi bi-plus-circle"></i>Add</button>
                <button class="btn btn-danger"><i class="bi bi-dash-circle"></i>Delete</button>
            </div>
        </div>
        <div class="container">
            {{$list}}
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 25%;">Nome</th>
                        <th style="width: 55%;">Descrição</th>
                        <th style="width: 15%;">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Oftalmo</td>
                        <td>Cuida dos olhos</td>
                        <td>
                            <div class="tabelaOpcoes">
                                <button class="btn btn-primary"><i class="bi bi-plus-circle">Editar</i></button>
                                <button class="btn btn-danger"><i class="bi bi-dash-circle">Excluir</i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            @foreach ($list as $especialidade)
                        <strong class="erro">{{ $especialidade }}</strong>
                    @endforeach
        </div>
    </div>

@stop
