@extends('adminlte::page')

@section('content_header')
<h1>Listar Projetos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse($projetos as $projeto)
    <tr>
        <td class="text-left">{{ $projeto->nome }}</td>
        <td class="text-left">{{ $projeto->parcela }}</td>
        <td class="text-left">{{ $projeto->planodecontas_id }}</td>
        <td class="text-left">
            @if ($projeto->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-left">
            <a href="/projeto/editar/{{$projeto->id}}" title='Editar as Informações do Projeto'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($projeto->status == "0")
            <a href="/projeto/ativar/{{$projeto->id }}" title='Ativa o Projeto'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/projeto/bloquear/{{$projeto->id }}" title='Bloqueia o Projeto'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/projeto/apagar/{{$projeto->id }}" title='Apaga o Projeto'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop