@extends('adminlte::page')

@section('content_header')
<div class="text-left">
    <h1>Listar Contratos</h1>
</div>
<div class="text-right">
    <a href="/importarcooperbrasil/importarcontratos"> 
        <input style="background-color: lightblue" type="button" value="Importar Contratos" name="Importar Contratos" />
    </a>
</div>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
        @forelse ($contratos as $contrato)
        <tr>
            <td class="text-left">{{ $contrato->RAZAO }}</td>
            <td class="text-left">{{ $contrato->ID_VEICULO1 }}</td>
            <td class="text-left">{{ $contrato->ID_VEICULO2 }}</td>
            <td class="text-left">{{ $contrato->ID_VEICULO3 }}</td>
            <td class="text-left">{{ $contrato->ID_VEICULO4 }}</td>
            <td class="text-left">{{ implode('/', array_reverse(explode('-', $contrato->DATA)))}}</td>
            <td class="text-left">{{ $contrato->ATIVO }}</td>
            <td class="text-left">
                @if ($contrato->importar == 1)
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"> Importar</span>
                @endif
                @if ($contrato->importar == 0)
                <span style="color:red" class="fas fa-ban" aria-hidden="true"> Cadastrado</span>
                @endif
                @if ($contrato->importar == 2)
                <span style="color:orange" class="fas fa-ban" aria-hidden="true"> Importado</span>
                @endif
            </td>
        </tr>
        @empty
        @endforelse
</x-adminlte-datatable>

@stop