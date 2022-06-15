@extends('adminlte::page')

@section('content_header')
<h1>Listar Formadepagamentos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse($formadepagamentos as $formadepagamento)
    <tr>
        <td class="text-left">{{ $formadepagamento->nome }}</td>
        <td class="text-left">{{ $formadepagamento->parcela }}</td>
        <td class="text-left">{{ $formadepagamento->planodecontas_id }}</td>
        <td class="text-left">
            @if ($formadepagamento->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-left">
            <a href="/formadepagamento/editar/{{$formadepagamento->id}}" title='Editar as Informações do Formadepagamento'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($formadepagamento->status == "0")
            <a href="/formadepagamento/ativar/{{$formadepagamento->id }}" title='Ativa o Formadepagamento'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/formadepagamento/bloquear/{{$formadepagamento->id }}" title='Bloqueia o Formadepagamento'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/formadepagamento/apagar/{{$formadepagamento->id }}" title='Apaga o Formadepagamento'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop