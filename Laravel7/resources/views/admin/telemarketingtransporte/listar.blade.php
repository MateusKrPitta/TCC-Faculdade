@extends('adminlte::page')

@section('content_header')
<h1>Ligações Realizadas</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse($telemarketingtransportes as $telemarketingtransporte)
    <tr>
        <td class="text-left">{{ $telemarketingtransporte->nome }}</td>
        <td class="text-left">{{ $telemarketingtransporte->tel1 }}</td>
        <td class="text-rigth">{{ $telemarketingtransporte->descricao }}</td>
        <td class="text-center">{{ implode('/', array_reverse(explode('-', substr($telemarketingtransporte->data, 0, -9)))) }}</td>
        <td class="text-center">{{ $telemarketingtransporte->nomeusuario }}</td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop