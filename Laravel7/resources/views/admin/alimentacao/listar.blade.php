@extends('adminlte::page')

@section('content_header')
<h1>Listar Alimentação</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($alimentacaos as $alimentacao)
    <tr>
        <td class="text-left">{{ $alimentacao->animal_nome}} </td>
        <td class="text-left">{{ $alimentacao->alimento_nome}} </td>
        <td class="text-left">{{ number_format($alimentacao->peso, 2, ',', '.')}} </td>
        <td class="text-left">{{ implode('/', array_reverse(explode('-', $alimentacao->dataalimentacao)))}} </td>
        <td class="text-center">
            @if($alimentacao->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif</td>
        <td class="text-center">
            <a href="/alimentacao/editar/{{ $alimentacao->id }}" title='Editar as Informações da Alimentação'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($alimentacao->status == "0") 
            <a href="/alimentacao/ativar/{{ $alimentacao->id }}" title='Ativa a Alimentação'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/alimentacao/bloquear/{{ $alimentacao->id }}" title='Bloqueia a Alimentação'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/alimentacao/apagar/{{ $alimentacao->id }}" title='Apaga a Alimentação'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse 
</x-adminlte-datatable>

@stop