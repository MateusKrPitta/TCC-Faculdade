@extends('adminlte::page')

@section('content_header')
<h1>Listar Medicos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($medicos as $medico)
    <tr>
        <td class="text-left">{{ $medico->nome}}</td>
        <td class="text-left">{{ $medico->nome_especialidade}}</td>
        <td class="text-left">{{ $medico->numeroconselhoregional}}</td>
        <td class="text-center">
            @if ($medico->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/medico/editar/{{ $medico->id }}" title='Editar as Informações do Médico'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($medico->status == "0") 
            <a href="/medico/ativar/{{ $medico->id }}" title='Ativa o Médico'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/medico/bloquear/{{ $medico->id }}" title='Bloqueia o Médico'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/medico/apagar/{{ $medico->id }}" title='Apaga o Médico'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>				
    </tr>
    @empty
    @endforelse     
</x-adminlte-datatable>

@stop