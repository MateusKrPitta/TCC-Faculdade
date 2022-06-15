@extends('adminlte::page')

@section('content_header')
<h1>Listar Agendas </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse($agenda as $agenda)
    <tr>
        <td class="text-left">{{ $agenda->nome }}</td>
        <td class="text-left">{{$agenda->evento}}</td>
        <td class="text-left">{{$agenda->data}}</td>
        <td class="text-left">{{$agenda->hora}}</td>
        <td class="text-center">
            @if($agenda->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/agenda/editar/{{ $agenda->id }}" title='Editar as Informações do Agenda'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if($agenda->status == "0") 
            <a href="/agenda/ativar/{{ $agenda->id }}" title='Ativa o Agenda'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/agenda/bloquear/{{ $agenda->id }}" title='Bloqueia o Agenda'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/agenda/apagar/{{ $agenda->id }}" title='Apaga o Agenda'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop