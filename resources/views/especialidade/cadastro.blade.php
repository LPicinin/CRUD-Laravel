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

    .formulario {
        display: flex;
        flex-direction: column;
        align-content: center;
        justify-content: center;
        width: 30em;
        margin: 0 auto;
    }

    .field {
        display: flex;
        flex-direction: column;
    }

    .required {
        color: red;
        font-weight: normal;
    }

</style>
@section('content')
    <div class="container">
        <h1>Cadastro de especialidade</h1>
        <div class="formulario">
            <form action="{{ route('salvarEspecialidade') }}" method="post">
                {{ csrf_field() }}
                <div class="field">
                    <label for="nome">Nome da Especialidade<span class="required">*</span></label>
                    <input type="text" id="nome" name="nome" required />

                    @if ($errors->has('nome'))
                        @foreach ($errors->get('nome') as $erro)
                            <strong class="erro">{{ $erro }}</strong>
                        @endforeach
                    @endif
                </div>
                <div class="field">
                    <label for="descricao">Descrição<span class="required">*</span></label>
                    <textarea rows="4" cols="50" type="text" id="descricao" name="descricao" required></textarea>

                    @if ($errors->has('descricao'))
                        @foreach ($errors->get('descricao') as $erro)
                            <strong class="erro">{{ $erro }}</strong>
                        @endforeach
                    @endif
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
        <div class="container">
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
        </div>
    </div>

@stop
