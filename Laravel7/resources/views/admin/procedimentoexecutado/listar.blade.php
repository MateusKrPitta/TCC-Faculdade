@extends('adminlte::page')

@section('content_header')
<h1>Listar Procedimentos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($procedimentoexecutados as $procedimentoexecutado)
    <tr>
        <td class="text-left">{{ $procedimentoexecutado->procedimento_nome}}</td>
        <td class="text-left">{{ $procedimentoexecutado->medico_nome}}</td>
        <td class="text-left">{{ $procedimentoexecutado->cliente_nome}}</td>
        <td class="text-left">{{ implode('/', array_reverse(explode('-', $procedimentoexecutado->data)))}}</td>
        <td class="text-right">R$ {{ number_format($procedimentoexecutado->valor,2,',','.')}}</td>
        <td class="text-center">
            @if ($procedimentoexecutado->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/procedimentoexecutado/editar/{{ $procedimentoexecutado->id }}" title='Editar as Informações do Procedimento'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($procedimentoexecutado->status == "0") 
            <a href="/procedimentoexecutado/ativar/{{ $procedimentoexecutado->id }}" title='Ativa o Procedimento'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/procedimentoexecutado/bloquear/{{ $procedimentoexecutado->id }}" title='Bloqueia o Procedimento'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/procedimentoexecutado/apagar/{{ $procedimentoexecutado->id }}" title='Apaga o Procedimento'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>				
    </tr>
    @empty
    @endforelse   
</x-adminlte-datatable>

@stop