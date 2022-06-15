@extends('adminlte::page')

@section('content_header')
<h1>Listar Viagems </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse($viagens as $viagem)
    <tr>
        <td class="text-left">{{ $viagem->nome}}</td>
        <td class="text-left">{{ $viagem->origem}}</td>
        <td class="text-left">{{ $viagem->destino}}</td>
        <td class="text-left">{{ date("d/m/Y", strtotime($viagem->data))}}</td>
        <td class="text-left">{{ $viagem->hora}}</td>
        <td class="text-right">R$ {{ number_format($viagem->valor, 2, ',', '.')}}</td>
        <td class="text-center">
            @if ($viagem->status == 1)
            Ativo
            @else
            Encerrado
            @endif
        </td>
        <td class="text-center">
            <a href="/viagem/listadepassageiros/{{$viagem->id }}" title='Lista de passageiros'>
                <span style="color:blue" class="fas fa-paste" aria-hidden="true"></span>
            </a>
            <a href="/viagem/editar/{{$viagem->id }}" title='Editar as Informações do Viagem'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($viagem->status == "0")
            <a href="/viagem/ativar/{{$viagem->id }}" title='Ativa o Viagem'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/viagem/bloquear/{{$viagem->id }}" title='Bloqueia o Viagem'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/viagem/apagar/{{$viagem->id }}" title='Apaga o Viagem'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop