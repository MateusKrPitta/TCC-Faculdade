@extends('adminlte::page')

@section('content_header')
<div class="text-left">
    <h1>Listar Veículos</h1>
</div>
<div class="text-right">
    <a href="/importarcooperbrasil/importarveiculos"> 
        <input style="background-color: lightblue" type="button" value="Importar Veiculos" name="Importar Veiculos" />
    </a>
</div>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
        @forelse ($veiculos as $veiculo)
        <tr>
            <td class="text-center">{{ $veiculo->PLACA }}</td>
            <td class="text-center">{{ $veiculo->NOME }}</td>
            <td class="text-center">{{ $veiculo->CIDADE }}-{{ $veiculo->END_ESTADO }}</td>
            <td class="text-center">{{ $veiculo->CNPJCPF }}</td>
            <td class="text-center">{{ implode('/', array_reverse(explode('-', $veiculo->DT_CAD)))}}</td>
            <td class="text-center">
                @if ($veiculo->importar == 1)
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"> Importar</span>
                @endif
                @if ($veiculo->importar == 0)
                <span style="color:red" class="fas fa-ban" aria-hidden="true"> Cadastrado</span>
                @endif
                @if ($veiculo->importar == 2)
                <span style="color:orange" class="fas fa-ban" aria-hidden="true"> Importado</span>
                @endif
            </td>
        </tr>
        @empty
        @endforelse
</x-adminlte-datatable>

@stop