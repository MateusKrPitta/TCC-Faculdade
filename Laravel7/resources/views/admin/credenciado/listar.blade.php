@extends('adminlte::page')

@section('content_header')
<h1>Listar Credenciados </h1>
@stop

@section('content')
<?php
//Atribui os acessos do Usuario
use App\Usuario;

//Atribui os acessos do Usuario
$usuario = Usuario::find(\Illuminate\Support\Facades\Auth::user()->id);
foreach ($usuario->permissaos as $permis) {
    Gate::define($permis->nome, function($user) {
        return 1;
    });
}
?>
<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse($credenciados as $credenciado)
    <tr>
        <td class="text-left">{{ $credenciado->nome}}</td>
        <td class="text-left">{{ $credenciado->tel1}}</td>
        <td class="text-left">{{ date('d/m/Y', strtotime($credenciado->created_at))}}</td>
        <td class="text-left">
            @if ($credenciado->status == 1)
            Ativo
            @endif
            @if ($credenciado->status == 0)
            Desativado
            @endif
        </td>
        <td class="text-center">
            @if ($credenciado->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">

            <a href="/credenciado/listarusuarios/{{$credenciado->id }}" title='Usuários'>
                <span style="color:blue" class="fas fa-users" aria-hidden="true"></span>
            </a>
            @can('menu-convenio-credenciado-editar')
            <a href="/credenciado/editar/{{$credenciado->id }}" title='Editar as Informações do Credenciado'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @endcan
            @if ($credenciado->status == "0") 
            <a href="/credenciado/ativar/{{$credenciado->id}}" title='Ativa o Credenciado'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/credenciado/bloquear/{{$credenciado->id }}" title='Bloqueia o Credenciado'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            @can('menu-convenio-credenciado-excluir')
            <a href="/credenciado/apagar/{{$credenciado->id }}" title='Apaga o Credenciado'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
            @endcan
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop