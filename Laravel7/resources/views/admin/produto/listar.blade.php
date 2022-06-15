@extends('adminlte::page')

@section('content_header')
<h1>Listar Produtos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($produtos as $produto)
    <tr>
        <td class="text-left">{{ $produto->nome }}</td>
        <td class="text-left">{{ $produto->codbarras }}</td>
        <td class="text-left">R$ {{ number_format($produto->valor,2,',','.') }}</td>
        <td class="text-left">{{ $produto->quantidade }}</td>
        <td class="text-center">
            @if ($produto->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td>
            <a href="/produto/editar/{{ $produto->id }}" title='Editar as Informações do Produto'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a> 
            @if ($produto->status == "0") 
            <a href="/produto/ativar/{{ $produto->id }}" title='Ativa o Produto'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/produto/bloquear/{{ $produto->id }}" title='Bloqueia o Produto'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/produto/apagar/{{ $produto->id }}" title='Apaga o Produto'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop