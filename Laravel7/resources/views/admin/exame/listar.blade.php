@extends('adminlte::page')

@section('content_header')
<h1>Listar Exames </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($exames as $exame)
    <tr>
        <td class="text-left">{{ $exame->nome}}</td>
        <td class="text-left">{{ $exame->valor}}</td>
        <td class="text-left">{{ $exame->valor_referencia}}</td>
        <td class="text-left">{{ $exame->tempo}}</td>
        <td class="text-center">
            @if ($exame->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/exame/editar/{{ $exame->id }}" title='Editar as Informações do Exame'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($exame->status == "0")
            <a href="/exame/ativar/{{ $exame->id }}" title='Ativa o Exame'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/exame/bloquear/{{ $exame->id }}" title='Bloqueia o Exame'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/exame/apagar/{{ $exame->id }}" title='Apaga o Exame'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop