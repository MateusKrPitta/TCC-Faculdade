@extends('adminlte::page')

@section('content_header')
<h1>Listar Ordem de Serviço </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($ordemdeservicos as $ordemdeservico)
    <tr>
        <td class="text-left">{{ $ordemdeservico->id}}</td>
        <td class="text-left">{{ $ordemdeservico->orcamento_id}}</td>
        <td class="text-left">{{ $ordemdeservico->clientes_nome}}</td>
        <td class="text-left">{{ $ordemdeservico->valor}}</td>
        <td class="text-center">
            @if ($ordemdeservico->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/ordemdeservico/editar/{{ $ordemdeservico->id }}" title='Editar as Informações do Orçamento'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($ordemdeservico->status == "0") 
            <a href="/orcamentodeservico/ativar/{{ $ordemdeservico->id }}" title='Ativa o Orçamento'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/orcamentodeservico/bloquear/{{ $ordemdeservico->id }}" title='Bloqueia o Orçamento'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/orcamento/apagar/{{ $ordemdeservico->id }}" title='Apaga o Orçamento'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>				
    </tr>
    @empty
    @endforelse     
</x-adminlte-datatable>

@stop