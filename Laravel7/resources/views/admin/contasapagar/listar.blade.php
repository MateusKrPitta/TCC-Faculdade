@extends('adminlte::page')

@section('content_header')
<h1>Lista de Contas a Pagar</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($contasapagar as $cp)
    <tr class="{{ $cp->contasapagars_status == 0 ? 'danger' : '' }}">
        <td>{{ $cp->fornecedores_nome}}</td>
        <td>{{ $cp->contasapagars_descricao}}</td>
        <td class="text-right">R$ {{ number_format($cp->contasapagars_valor,2,',','.')}}</td>
        <td class="text-center">{{ $cp->contasapagars_vencimento }}</td>
        <td class="text-center">{{ $cp->contasapagars_pagamento }}</td>
<!-- 
        <td class="text-center">{{ implode('/', array_reverse(explode('-', $cp->contasapagars_vencimento)))}}</td>
        <td class="text-center">{{ implode('/', array_reverse(explode('-', $cp->contasapagars_pagamento)))}}</td>
-->
        <td class="text-center">
            @if($cp->contasapagars_status == 0)
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
            @if ($cp->contasapagars_status == 1) 
            <span class="fas fa-hourglass-half" aria-hidden="true"></span>
            @endif
            @if ($cp->contasapagars_status == 2)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @endif
        </td>
        <td>
            <a href="/contasapagar/editar/{{ $cp->contasapagars_id }}" title='Alterar a conta'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if($cp->contasapagars_status == 2)
            <span style="color:gray" class="fas fa-money-check-alt" aria-hidden="true"></span>

            @else 
            <a href="/contasapagar/receber/{{ $cp->contasapagars_id }}" title='Pagar a conta'>
                <span style="color:green" class="fas fa-money-check-alt" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/contasapagar/apagar/{{ $cp->contasapagars_id }}" title='Cancelar a Conta'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop