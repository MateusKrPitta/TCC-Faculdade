@extends('adminlte::page')

@section('content_header')
<h1>Listar Conveniados </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse($conveniados as $conveniado)
    <tr>
        <td class="text-left">{{ $conveniado->nome}}</td>
        <td class="text-left">{{ $conveniado->titular_id}}</td>
        <td class="text-left">{{ $conveniado->nascimento}}</td>
        <td class="text-left">{{ $conveniado->sexo}}</td>
        <td class="text-left">{{ $conveniado->cidade}}</td>
        <td class="text-left">{{ $conveniado->plano_id}}</td>
        <td class="text-left">{{ $conveniado->datadocontrato}}</td>
        <td class="text-center">
            @if ($conveniado->status == "0") 
            Inativo
            @endif
            @if ($conveniado->status == "1")
            Ativo
            @endif
            @if ($conveniado->status == "2")
            Aguardando Contrato
            @endif
            @if ($conveniado->status == "3")
            Aguardando Assinatura
            @endif
            @if ($conveniado->status == "4")
            Aguardando Pagamento
            @endif
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>
@stop