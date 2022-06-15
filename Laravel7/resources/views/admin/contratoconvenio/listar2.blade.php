@extends('adminlte::page')

@section('content_header')
<h1>Listar Contratos </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @foreach($contratos as $contrato)
    <tr>
        <td class="text-left">{{ $contrato->conveniado_nome}}</td>
        <td class="text-left">{{ $contrato->conveniado_nascimento}}</td>
        <td class="text-left">{{ $contrato->conveniado_sexo}}</td>
        <td class="text-left">{{ $contrato->conveniado_cidade}}</td>
        <td class="text-left">{{ $contrato->plano_nome}}</td>
        <td class="text-left">{{ $contrato->valor}}</td>
        <td class="text-left">{{ $contrato->formadepagamento_nome}}</td>
        <td class="text-left">{{ $contrato->datadocontrato}}</td>
        <td class="text-center">
            @if ($contrato->status == "0") 
            Inativo
            @endif
            @if ($contrato->status == "1")
            Ativo
            @endif
            @if ($contrato->status == "2")
            Aguardando Contrato
            @endif
            @if ($contrato->status == "3")
            Aguardando Assinatura
            @endif
            @if ($contrato->status == "4")
            Aguardando Pagamento
            @endif
        </td>
    </tr>
    @endforeach
</x-adminlte-datatable>


@stop