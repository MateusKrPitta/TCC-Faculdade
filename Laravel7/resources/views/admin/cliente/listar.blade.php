@extends('adminlte::page')

@section('content_header')
<h1>Listar Clientes </h1>
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
    @forelse($clientes as $cliente)
    <tr>
        <td class="text-left">{{$cliente->nome}}</td>
        <td class="text-left">{{$cliente->tel1}}</td>
        <td class="text-left">{{$cliente->cpfcnpj}}</td>
        <td class="text-left">{{$cliente->rgie}}</td>
        <td class="text-left">{{implode('/', array_reverse(explode('-', $cliente->nascimento)))}}</td>
        <td class="text-center">
            @if ($cliente->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            @can('menu-transportadora-passagem-cadastrar')
            <a href="/passagem/comprar/{{$cliente->id }}" title='Comprar passagem'>
                <span style="color:blue" class="fas fa-bus" aria-hidden="true"></span>
            </a>
            @endcan
            @can('menu-atendimento-clientes-editar')
            <a href="/cliente/editar/{{$cliente->id }}" title='Editar as Informações do Cliente'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @endcan
            @if ($cliente->status == "0") 
            <a href="/cliente/ativar/{{$cliente->id }}" title='Ativa o Cliente'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/cliente/bloquear/{{$cliente->id }}" title='Bloqueia o Cliente'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            @can('menu-atendimento-clientes-excluir')
            <a href="/cliente/apagar/{{$cliente->id }}" title='Apaga o Cliente'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
            @endcan
        </td>
        @empty
        @endforelse
</x-adminlte-datatable>

@stop