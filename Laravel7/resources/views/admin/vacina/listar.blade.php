@extends('adminlte::page')

@section('content_header')
<h1>Listar Animais</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>

    @forelse($vacina as $vacina)
    <tr>
        <td class="text-left">{{$vacina->nomevacina}}</td>
        <td class="text-left">
            @if($vacina->sexoaplicacao == "A") Ambos @endif
            @if($vacina->sexoaplicacao == "M") Machos @endif
            @if($vacina->sexoaplicacao == "F") Fêmeas @endif
            @if ($vacina->sexoaplicacao == "I") Indeterminado @endif 

        </td>
        <td class="text-left">{{implode('/', array_reverse(explode('-', $vacina->datainicio)))}}</td>
        <td class="text-left">{{implode('/', array_reverse(explode('-', $vacina->datafim)))}}</td>
        <td class="text-left">
            @if($vacina->tipovacina == "A") Aleatória @endif
            @if($vacina->tipovacina == "U") Única @endif
            @if($vacina->tipovacina == "P") Periódica @endif
            @if ($vacina->sexoaplicacao == "I")Indeterminada @endif

        </td>
        <td class="text-left">{{$vacina->intervalovacina}}</td>
        <td class="text-center">
            @if ($vacina->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td >
            <a href="/vacina/editar/{{$vacina->id }}" title='Editar as Informações do Animal'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($vacina->status == "0") 
            <a href="/vacina/ativar/{{$vacina->id }}" title='Ativa o Animal'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/vacina/bloquear/{{$vacina->id }}" title='Bloqueia o Animal'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/vacina/apagar/{{$vacina->id }}" title='Apaga o Animal'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>
@stop