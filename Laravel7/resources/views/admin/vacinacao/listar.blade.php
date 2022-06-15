@extends('adminlte::page')

@section('content_header')
<h1>Listar Animais</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($animais as $animal)
    <tr>
        <td class="text-left">{{ $animal->animal_nome }}</td>
        <td class="text-left">{{ $animal->vacina_nome }}</td>
        <td class="text-left">{{ implode('/', array_reverse(explode('-', $animal->datavacina)))}}</td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop