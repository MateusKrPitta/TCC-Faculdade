@extends('adminlte::page')

@section('content_header')
<h1>Listar Consultas </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse($consultas as $consultas)
    <tr>
        <td class="text-left">{{ $consultas->cliente_nome}}</td>
        <td class="text-left">{{ $consultas->medico_nome}}</td>
        <td class="text-left">{{ $consultas->data}}</td>
        <td class="text-left">{{ $consultas->hora}}</td>
        <td class="text-center">
            @if ($consultas->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/consulta/editar/{{$consultas->id }}" title='Editar as Informações da Consulta'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>

            @if ($consultas->status == "0") 
            <a href="/consulta/ativar/{{$consultas->id }}" title='Ativa a Consulta'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/consulta/bloquear/{{$consultas->id }}" title='Bloqueia a Consulta'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif

            <a href="/consulta/apagar/{{$consultas->id }}" title='Apaga a Consulta'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>				
    </tr>
    @empty
    @endforelse     
</x-adminlte-datatable>
@stop