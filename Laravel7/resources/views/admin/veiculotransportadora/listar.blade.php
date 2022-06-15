@extends('adminlte::page')

@section('content_header')
<h1>Listar Veiculos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($veiculos as $veiculotransportadora)
    <tr>
        <td class="text-left">{{ $veiculotransportadora->nome}}</td>
        <td class="text-left">{{ $veiculotransportadora->acentos}}</td>
        <td class="text-left">{{ $veiculotransportadora->marca}} {{ $veiculotransportadora->marcamodelo}}</td>
        <td class="text-left">{{ $veiculotransportadora->placa}}</td>
        <td class="text-center">
            @if ($veiculotransportadora->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/veiculotransportadora/editar/{{$veiculotransportadora->id }}" title='Editar as Informações do Veiculo'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($veiculotransportadora->status == "0") 
            <a href="/veiculotransportadora/ativar/{{$veiculotransportadora->id }}" title='Ativa o Veiculo'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/veiculotransportadora/bloquear/{{$veiculotransportadora->id }}" title='Bloqueia o Veiculo'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/veiculotransportadora/apagar/{{$veiculotransportadora->id }}" title='Apaga o Veiculo'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop