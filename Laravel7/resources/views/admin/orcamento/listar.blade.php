@extends('adminlte::page')

@section('content_header')
<h1>Listar Orçamentos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse($orcamentos as $orcamentos)
    <tr>
        <td class="text-left">{{$orcamentos->cliente_nome}}</td>
        <td class="text-left">{{date('d/m/Y', strtotime($orcamentos->data))}}</td>
        <td class="text-center">
            @if ($orcamentos->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif 
        </td>
        <td class="text-center">
            <a href="/orcamento/editar/{{$orcamentos->id }}" title='Editar as Informações do Cliente'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($orcamentos->status == "0") 
            <a href="/orcamento/ativar/{{$orcamentos->id }}" title='Ativa o Cliente'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/orcamento/bloquear/{{$orcamentos->id }}" title='Bloqueia o Cliente'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/orcamento/apagar/{{$orcamentos->id }}" title='Apaga o Cliente'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop