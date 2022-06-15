@extends('adminlte::page')

@section('content_header')
<h1>Listar Animais</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($gestacao as $gestacao)
    <tr>
        <td class="text-left">{{ $gestacao->nome}}</td>
        <td class="text-left">{{ date('d/m/Y', strtotime($gestacao->dataconfirmacao))}}</td>
        <td class="text-left">{{ $gestacao->examinador}}</td>
        <td class="text-center">
            @if ($gestacao->status_gestacao == '0') Aguardadno
            <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
            @endif   
            @if ($gestacao->status_gestacao == '1')   Gestando
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            @endif    
            @if ($gestacao->status_gestacao == '2')  Não fecundou
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            @endif
        <td class="text-center">
            {{ date('d/m/Y', strtotime(\App\Http\Controllers\Admin\InseminacaoController::previsaoParto($gestacao->inseminacao_id)))}}
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop