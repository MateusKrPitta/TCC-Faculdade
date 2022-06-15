@extends('adminlte::page')

@section('content_header')
<h1>Listar Passagems </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($passagens as $passagem)
    <tr>
        <td class="text-left">{{ $passagem->cliente_nome }}</td>
        <td class="text-left">{{ $passagem->viagem_nome }}</td>
        <td class="text-left">{{ date("d/m/Y", strtotime($passagem->viagem_data)) }}</td>
        <td class="text-left">{{ $passagem->acento }}</td>
        <td class="text-right">R$ {{ number_format($passagem->valor, 2, ',', '.') }}</td>
        <td class="text-left">{{ $passagem->nomeusuario }}</td>
        <td class="text-center">
            <a href="/passagem/apagar/{{$passagem->id}}" title='Apaga o Passagem'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop