@extends('adminlte::page')

@section('content_header')
<h1>Lista de Contas a Receber</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($contasareceber as $cr)
    <tr class="{{ $cr->contasarecebers_status == 0 ? 'danger' : '' }}">
        <td>{{ $cr->clientes_nome}}</td>
        <td>{{ $cr->contasarecebers_descricao}}</td>
        <td class="text-right">R$ {{ number_format($cr->contasarecebers_valor,2,',','.')}}</td>
        <td class="text-center">{{ $cr->contasarecebers_vencimento }}</td>
        <td class="text-center">{{ $cr->contasarecebers_pagamento }}</td>
        <td class="text-center">
            @if($cr->contasarecebers_status == 0) 
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
            @if($cr->contasarecebers_status == 1) 
            <span class="fas fa-hourglass-half" aria-hidden="true"></span>
            @endif            
            @if ($cr->contasarecebers_status == 2)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @endif
        </td>
        <td>
            <a href="/contasareceber/editar/{{$cr->contasarecebers_id }}" title='Alterar a conta'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($cr->contasarecebers_status == 2)
            <span style="color:gray" class="fas fa-money-check-alt" aria-hidden="true"></span>
            @else					
            <a href="/contasareceber/receber/{{$cr->contasarecebers_id }}" title='Receber a conta'>
                <span style="color:green" class="fas fa-money-check-alt" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/contasareceber/apagar/{{$cr->contasarecebers_id }}" title='Cancelar a Conta'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop