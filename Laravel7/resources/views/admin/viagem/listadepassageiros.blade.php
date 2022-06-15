@extends('adminlte::page')

@section('content_header')
<h1>Listar Passageiros </h1>
@stop

@section('content')
<h3 class="text-center"  > Lista de Passageiros - Viagem: {{$viagem[0]->nome}} - Data: {{date("d/m/Y", strtotime($viagem[0]->data))}}</h3>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center">Nome</th>
            <th class="text-center">Telefone</th>
            <th class="text-center">RG</th>
            <th class="text-center">CPF</th>
            <th class="text-center">Poltrona</th>
            <th class="text-center">Embarque</th>
            <th class="text-center">Valor</th>
            <th class="text-center">Situação</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($passageiros as $passageiro)
            <tr>
                <td class="text-left">{{ $passageiro->cliente_nome}}</td>
                <td class="text-center">{{ $passageiro->cliente_tel1}}</td>
                <td class="text-center">{{ $passageiro->cliente_rg}}</td>
                <td class="text-center">{{ $passageiro->cliente_cpf}}</td>
                <td class="text-center">{{ $passageiro->acento}}</td>
                <td class="text-center">{{ $passageiro->localembarque}} </td>
                <td class="text-right">R$ {{ number_format($passageiro->valor, 2, ',', '.')}}</td>
                <td class="text-center">
                    @if ($passageiro->status == 1)
                        <span class="fas fa-check-square" aria-hidden="true"></span>
                    @else
                        <span class="fas fa-ban" aria-hidden="true"></span>
                    @endif
                </td>
            </tr>
            @empty
       @endforelse
        <tr>
            <th class="text-center"></th>
            <th class="text-center"></th>
            <th class="text-center"></th>
            <th class="text-center"></th>
            <th class="text-center"></th>
            <th class="text-right">Total</th>
            <th class="text-right">R$ {{ number_format($somapassagens, 2, ',', '.') }}</th>
            <th class="text-center"></th>
        </tr>
    </tbody>
</table>

<input class="btn btn-lg btn-warning btn-block no-print" type="button" value="Imprimir" onclick="window.print()"/>


@stop