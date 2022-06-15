@extends('adminlte::page')

@section('content_header')
<h1>Listar Animais Inseminados</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse($inseminacaos as $inseminacao)
    <tr>
        <td class="text-center"><a href="/inseminacao/ficha/{{$inseminacao->animal_id }}" title='Ficha do Animal'>{{ $inseminacao->nome}}</a></td>
        <td class="text-center">{{ date('d/m/Y', strtotime($inseminacao->datainseminacao)) }}</td>
        <td class="text-center">
            @if($inseminacao->turno == 'M' ) Manhã @endif
            @if($inseminacao->turno == 'T' ) Tarde @endif
            @if($inseminacao->turno == 'N' ) Noite @endif
        </td>
        <td class="text-center">{{ $inseminacao->touro }}</td>
        <td class="text-center">{{ $inseminacao->inseminador }}</td>
        <td class="text-center">
            @if ($inseminacao->status_inseminacao == '0') <!--Aguardadno-->
            <span style="color:black" class="fas fa-clock" aria-hidden="true"></span>
            @endif
            @if ($inseminacao->status_inseminacao == '1')  <!--Gestando-->
            <span style="color:green" class="fas fa-check" aria-hidden="true"></span>
            @endif
            @if ($inseminacao->status_inseminacao == '2')  <!--Não fecundou ou finalizado-->
            <span class="fas fa-horse" style="color: red" > Morto </span>              
            @endif
        </td>
        <td class="text-center">
            @if($inseminacao->id)
            {{ date('d/m/Y', strtotime(\App\Http\Controllers\Admin\InseminacaoController::previsaoParto($inseminacao->id)))}}
            @endif
        </td>
        <td class="text-center">
            <a href="/inseminacao/editar/{{$inseminacao->id }}" title='Editar as Informações da Inseminação'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            <a href="/inseminacao/apagar/{{$inseminacao->id }}" title='Apaga a Inseminação'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop