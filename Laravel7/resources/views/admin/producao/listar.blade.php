@extends('adminlte::page')

@section('content_header')
<h1>Produção Diária</h1>
@stop

@section('content')
<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($listaproducao as $producao)
    <tr>
        <td class="text-left">{{ $producao->nome}}</td>
        <td class="text-left">{{  date( 'd/m/Y' , strtotime($producao->data_producao)) }}</td>
        <td class="text-left">{{ $producao->hora_producao}}</td>
        <td class="text-left">{{ $producao->quantidade}}</td>
        <td class="text-center">
            <a href="/producao/editar/{{ $producao->producao_id }}" title='Altera o Registro'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            <a href="/producao/apagar/{{ $producao->producao_id }}" title='Apaga o Registro'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop