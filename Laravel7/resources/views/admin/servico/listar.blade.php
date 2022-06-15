@extends('adminlte::page')

@section('content_header')
<h1>Listar Servicos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($servico as $servico)
    <tr>
        <td class="text-left">{{ $servico->nome}}</td>
        <td class="text-left">{{ $servico->tempo}}</td>
        <td class="text-left">{{ $servico->valor}}</td>
        <td class="text-center">
            @if ($servico->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td>
            <a href="/servico/editar/{{$servico->id }}" title='Editar as Informações do Servico'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($servico->status == "0") 
            <a href="/servico/ativar/{{$servico->id }}" title='Ativa o Servico'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/servico/bloquear/{{$servico->id }}" title='Bloqueia o Servico'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/servico/apagar/{{$servico->id }}" title='Apaga o Servico'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop