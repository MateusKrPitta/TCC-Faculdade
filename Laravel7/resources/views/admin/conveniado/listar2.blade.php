@extends('adminlte::page')

@section('content_header')
<h1>Listar Conveniados </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse($conveniados as $conveniado)
    <tr>
        <td class="text-left">{{ $conveniado->nome}}</td>
        <td class="text-left">{{ $conveniado->titular}}</td>
        <td class="text-left">{{ $conveniado->tel1}}</td>
        <td class="text-left">{{ $conveniado->nascimento}}</td>
        <td class="text-left">{{ $conveniado->datadevalidade}}</td>
        <td class="text-left">{{ $conveniado->numeronocartao }}</td>
        <td class="text-left">{{ $conveniado->id}}</td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>
@stop