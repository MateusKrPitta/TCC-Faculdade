@extends('adminlte::page')

@section('content_header')
<h1>Usuários para credenciado: {{ $credenciado->nome }}</h1>
@stop

@section('content')

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center">Nome</th>
            <th class="text-center">Permissão</th>
            <th class="text-center">Usuário</th>
            <th class="text-center">Data Cadastro</th>
            <th class="text-center">Status</th>
            <th class="text-center" colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($usuarios as $usuario)
        <tr>
            <td class="text-center">{{ $usuario->nome}}</td>
            <td class="text-center">{{ $usuario->perfils_nome}}</td>
            <td class="text-center">{{ $usuario->email}}</td>
            <td class="text-center">{{ date("d/m/Y", strtotime($usuario->created_at)) }}</td>
            <td class="text-center">
                @if ($usuario->status == 1)
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
                @else
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
                @endif
            </td>
            <td class="text-center">
                @if ($usuario->status == "0") 
                <a href="/credenciado/ativarusuario/{{$usuario->id}}/{{$credenciado->id}}" title='Ativar o Usuário'>
                    <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
                </a>
                @else
                <a href="/credenciado/bloquearusuario/{{$usuario->id}}/{{$credenciado->id}}" title='Bloquear o Usuário'>
                    <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
                </a>
                @endif
            </td>
            <td class="text-center">
                <a href="/credenciado/apagarusuario/{{$usuario->id}}/{{$credenciado->id}}" title='Apagar o Usuário'>
                    <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td class="text-center">Nenhum usuário cadastrado.</td>
            <td class="text-center">Nenhum usuário cadastrado.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!--Formulario-->
<form class="needs-validation" name='FormularioCadastrarUsuarioCredenciado' id='FormularioCadastrarUsuarioCredenciado' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >
    <fieldset title='Informações do Usuário' name='blocoform01' id='blocoform01'><legend>Adicionar novo usuário</legend>
        <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
        <input type="hidden" name="credenciado_id" value="{{ $credenciado->id }}" />
        <div class="col-md-3 mb-3">
            <label class="" for='user_id'>Usuário</label>
            <x-adminlte-select2 class="form-control" name="user_id" title='Escolha o usuário'>
                @forelse($todosusuarios as $todosusuario)
                <option value="{{$todosusuario->id}}" >{{$todosusuario->name }} </option>
                @empty
                <option value="">Nenhum usuário cadastrado</option> 
                @endforelse
            </x-adminlte-select2>
        </div>
        <div class="control-label col-sm-4" >
            <button class="btn btn-lg btn-success" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Adicionar Usuário</button>
        </div>
    </fieldset>
</form>


@stop