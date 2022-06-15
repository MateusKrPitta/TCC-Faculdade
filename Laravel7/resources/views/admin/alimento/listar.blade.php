@extends('adminlte::page')

@section('content_header')
<h1>Listar Alimento / Ração</h1>
@stop

@section('content')


<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($alimentos as $alimento)
    <tr>
        <td class="text-left">{{ $alimento->nome}}</td>
        <td class="text-left">{{ $alimento->composicao}}</td>
        <td class="text-left">{{ number_format($alimento->peso, 2, ',', '.')}}</td>
        <td class="text-left">{{ number_format($alimento->valor, 2, ',', '.')}}</td>
        <td class="text-left">{{ implode('/', array_reverse(explode('-', $alimento->inicio)))}}</td>
        <td class="text-left">{{ implode('/', array_reverse(explode('-', $alimento->fim)))}}</td>
        <td class="text-center">
            @if ($alimento->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/alimento/editar/{{ $alimento->id }}" title='Editar as Informações do Alimento'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if($alimento->status == "0")
            <a href="/alimento/ativar/{{ $alimento->id }}" title='Ativa o Alimento'>
                <span style="color:blue" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/alimento/bloquear/{{ $alimento->id }}" title='Bloqueia o Alimento'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/alimento/apagar/{{ $alimento->id }}" title='Apaga o Alimento'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop