@extends('adminlte::page')

@section('content_header')
<h1>Listar Procedimentos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($procedimentos as $procedimento)
    <tr>
        <td class="text-left">{{ $procedimento->nome}}</td>
        <td class="text-left">{{ $procedimento->nome_especialidade}}</td>
        <td class="text-left">{{ $procedimento->tempo}}</td>
        <td class="text-left">{{ $procedimento->valor}}</td>
        <td class="text-center">
            @if ($procedimento->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td>
            <a href="/procedimento/editar/{{ $procedimento->id }}" title='Editar as Informações do Procedimento'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($procedimento->status == "0") 
            <a href="/procedimento/ativar/{{ $procedimento->id }}" title='Ativa o Procedimento'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/procedimento/bloquear/{{ $procedimento->id }}" title='Bloqueia o Procedimento'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/procedimento/apagar/{{ $procedimento->id }}" title='Apaga o Procedimento'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>				
    </tr>
    @empty
    @endforelse   
</x-adminlte-datatable>

@stop