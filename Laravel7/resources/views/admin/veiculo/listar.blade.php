@extends('adminlte::page')

@section('content_header')
<h1>Listar Veiculos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($veiculos as $veiculo)
    <tr>
        <td class="text-left">{{ $veiculo->cliente_nome}}</td>
        <td class="text-left">{{ $veiculo->marca}} {{ $veiculo->marcamodelo}}</td>
        <td class="text-left">{{ $veiculo->placa}}</td>
        <td class="text-center">
            @if ($veiculo->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/veiculo/editar/{{$veiculo->id }}" title='Editar as Informações do Veiculo'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($veiculo->status == "0") 
            <a href="/veiculo/ativar/{{$veiculo->id }}" title='Ativa o Veiculo'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/veiculo/bloquear/{{$veiculo->id }}" title='Bloqueia o Veiculo'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/veiculo/apagar/{{$veiculo->id }}" title='Apaga o Veiculo'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop