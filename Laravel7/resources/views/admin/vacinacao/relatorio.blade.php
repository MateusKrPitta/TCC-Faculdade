@extends('adminlte::page')

@section('content_header')
<h1>Listar Animais</h1>
@stop

@section('content')

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center">Vacina</th>
            <th class="text-center">Animal</th>
            <th class="text-center">Data da Vacina</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($animais as $animal)
        <tr>

            <td class="text-center">{{ $animal->vacina_nome }}</td>
            <td class="text-center">{{ $animal->animal_nome }}</td>
            <td class="text-center">{{ implode('/', array_reverse(explode('-', $animal->datavacina)))}}</td>

        </tr>
        @empty
        @endforelse
    </tbody>
</table>

@stop