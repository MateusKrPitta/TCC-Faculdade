@extends('adminlte::page')

@section('content_header')
<h1>Listar Especialidades </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
        @forelse ($especialidades as $especialidade)
        <tr>
            <td class="text-left">{{ $especialidade->nome}}</td>
            <td class="text-left">{{ $especialidade->conselhoregional}}</td>
            <td class="text-center">
                @if ($especialidade->status == 1)
                <span class="fas fa-check-square" aria-hidden="true"></span>
                @else
                <span class="fas fa-ban" aria-hidden="true"></span>
                @endif
            </td>
            <td class="text-center">
                <a href="/especialidade/editar/{{ $especialidade->id }}" title='Editar as Informações da Especialidade'>
                    <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
                </a>
                @if ($especialidade->status == "0")
                <a href="/especialidade/ativar/{{ $especialidade->id }}" title='Ativa a Especialidade'>
                    <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
                </a>
                @else
                <a href="/especialidade/bloquear/{{ $especialidade->id }}" title='Bloqueia a Especialidade'>
                    <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
                </a>
                @endif
                <a href="/especialidade/apagar/{{ $especialidade->id }}" title='Apaga a Especialidade'>
                    <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
                </a>
            </td>
        </tr>
        @empty
        @endforelse
</x-adminlte-datatable>

@stop