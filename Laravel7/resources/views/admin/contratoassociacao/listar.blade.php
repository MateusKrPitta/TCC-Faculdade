@extends('adminlte::page')

@section('content_header')
<h1>Listar Contratos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($contratoassociacao as $contratoassociacao)
    <tr>
        <td class="text-left">{{$contratoassociacao->cliente_nome}}</td>
        <td class="text-left">{{mb_substr( $contratoassociacao->observacao, 0, 60, 'UTF-8' )}}</td>
        <td class="text-left">{{$contratoassociacao->data}}</td>
        <td class="text-right">{{number_format($contratoassociacao->valortotal,2,',','.')}}</td>
        <td class="text-center">
            @if ($contratoassociacao->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/contratoassociacao/imprimircontrato/{{$contratoassociacao->id }}" title='Imprimir Contrato'>
                <span style="color:blue" class="far fa-file-alt" aria-hidden="true"></span>
            </a>
            <a href="/contratoassociacao/editar/{{$contratoassociacao->id }}" title='Editar as Informações da Locação'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($contratoassociacao->status == "0")
            <a href="/contratoassociacao/ativar/{{ $contratoassociacao->id }}" title='Ativa a Locação'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/contratoassociacao/bloquear/{{$contratoassociacao->id }}" title='Bloqueia a Locação'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/contratoassociacao/apagar/{{$contratoassociacao->id }}" title='Apaga a Locação'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop