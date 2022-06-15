@extends('adminlte::page')

@section('content_header')
<h1>Listar Cartaos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($cartaos as $cartao)
    <tr>
        <td class="text-left">{{$cartao->conveniado_id}}</td>
        <td class="text-left">{{$cartao->nomenocartao}}</td>
        <td class="text-left">{{$cartao->numeronocartao}}</td>
        <td class="text-left">{{implode('/', array_reverse(explode('-', $cartao->datadeemissao)))}}</td>
        <td class="text-left">{{implode('/', array_reverse(explode('-', $cartao->datadevalidade)))}}</td>
        <td class="text-left">{{$cartao->name}}</td>
        <td class="text-center">
            @if($cartao->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/cartao/editar/{{$cartao->id }}" title='Editar as Informações do Cartao'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if($cartao->status == 0)
            <a href="/cartao/ativar/{{$cartao->id }}" title='Ativa o Cartao'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/cartao/bloquear/{{$cartao->id }}" title='Bloqueia o Cartao'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/cartao/apagar/{{$cartao->id }}" title='Apaga o Cartao'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop