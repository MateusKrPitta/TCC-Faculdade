@extends('adminlte::page')

@section('content_header')
<h1>Listar Contratos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($contratoescola as $contratoescola)
    <tr>
        <td class="text-left">{{$contratoescola->cliente_nome}}</td>
        <td class="text-left">{{$contratoescola->aluno_nome}}</td>
        <td class="text-left">{{$contratoescola->datadocontrato}}</td>
        <td class="text-right">{{number_format($contratoescola->valor,2,',','.')}}</td>
        <td class="text-center">
            @if ($contratoescola->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/contratoescola/imprimircontrato/{{$contratoescola->id }}" title='Imprimir Contrato'>
                <span style="color:blue" class="far fa-file-alt" aria-hidden="true"></span>
            </a>
            <a href="/contratoescola/editar/{{$contratoescola->id }}" title='Editar as Informações da Locação'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($contratoescola->status == "0")
            <a href="/contratoescola/ativar/{{ $contratoescola->id }}" title='Ativa a Locação'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/contratoescola/bloquear/{{$contratoescola->id }}" title='Bloqueia a Locação'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/contratoescola/apagar/{{$contratoescola->id }}" title='Apaga a Locação'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop