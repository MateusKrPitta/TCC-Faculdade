@extends('adminlte::page')

@section('content_header')
<h1>Controlar Cartões </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($cartaos as $cartao)
    <tr>
        <td class="text-left">{{ $cartao->nomenocartao }}</td>
        <td class="text-left">{{ $cartao->numeronocartao }}</td>
        <td class="text-left">{{ $cartao->nascimento }}</td>
        <td class="text-left">{{ $cartao->datadevalidade }}</td>
        <td class="text-left">{{ $cartao->titular_id }}</td>
        <td class="text-left">{{ $cartao->plano_id }}</td>
        <td class="text-center">
            @if($cartao->status == 1)
            <span style="color: green">Ativo</span>
            @else
            <span style="color: red">Inativo</span>
            @endif
        </td>
        <td class="text-left">
            @if($cartao->dataproducao)
            <a href="/cartao/desproduzir/{{$cartao->id }}" title='Remover'>
                <span style="color: green">{{ $cartao->dataproducao }}</span>
            </a>
            @else
            <a href="/cartao/produzir/{{$cartao->id }}" title='Produzir o Cartao'>
                <span style="color: red">Produzir</span>
            </a>
            @endif
        </td>
        <td class="text-left">
            @if($cartao->dataentrega)
            <a href="/cartao/desentregar/{{$cartao->id }}" title='Remover'>
                <span style="color: green">{{ $cartao->dataentrega }}</span>
            </a>
            @else
            <a href="/cartao/entregar/{{$cartao->id }}" title='Entregar o Cartao'>
                <span style="color: red">Entregar</span>
            </a>
            @endif
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop