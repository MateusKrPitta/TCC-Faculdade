@extends('adminlte::page')

@section('content_header')
<h1>Listar Locações </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($contratoviagem as $contratoviagem)
    <tr>
        <td class="text-left">{{ $contratoviagem->cliente_nome}}</td>
        <td class="text-left">{{ $contratoviagem->cliente_tel1}}</td>
        <td class="text-left">{{ $contratoviagem->veiculo_nome}}</td>
        <td class="text-left">{{  $contratoviagem->localdedestino}}</td>
        <td class="text-left">{{ implode('/', array_reverse(explode('-', $contratoviagem->datainicio)))}}</td>
        <td class="text-right">{{ number_format($contratoviagem->valor,2,',','.')}}</td>
        <td class="text-center">
            @if ($contratoviagem->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/contratoviagem/imprimircontrato/{{$contratoviagem->id }}" title='Imprimir Contrato'>
                <span style="color:blue" class="far fa-file-alt" aria-hidden="true"></span>
            </a>
            <a href="/contratoviagem/editar/{{$contratoviagem->id }}" title='Editar as Informações da Locação'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($contratoviagem->status == "0")
            <a href="/contratoviagem/ativar/{{ $contratoviagem->id }}" title='Ativa a Locação'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/contratoviagem/bloquear/{{$contratoviagem->id }}" title='Bloqueia a Locação'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/contratoviagem/apagar/{{$contratoviagem->id }}" title='Apaga a Locação'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop