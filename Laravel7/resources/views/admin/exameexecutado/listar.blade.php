@extends('adminlte::page')

@section('content_header')
<h1>Listar Exames Executados </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($exameexecutados as $exameexecutado)
    <tr>
        <td class="text-left">{{ $exameexecutado->exames_nome}}</td>
        <td class="text-left">{{ $exameexecutado->cliente_nome}}</td>
        <td class="text-left">{{ $exameexecutado->hora}}</td>
        <td class="text-left">{{ implode('/', array_reverse(explode('-', $exameexecutado->data)))}}</td>
        <td class="text-center">
            @if ($exameexecutado->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/exameexecutado/editar/{{ $exameexecutado->id }}" title='Editar as Informações do Exame'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($exameexecutado->status == "0")
            <a href="/exameexecutado/ativar/{{ $exameexecutado->id }}" title='Ativa o Exame'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/exameexecutado/bloquear/{{ $exameexecutado->id }}" title='Bloqueia o Exame'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/exameexecutado/apagar/{{ $exameexecutado->id }}" title='Apaga o Exame'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>


@stop