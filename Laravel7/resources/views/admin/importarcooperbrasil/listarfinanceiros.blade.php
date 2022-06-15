@extends('adminlte::page')

@section('content_header')
<div class="text-left">
    <h1>Listar Financeiros</h1>
</div>
<div class="text-right">
    <a href="/importarcooperbrasil/importarfinanceiros"> 
        <input style="background-color: lightblue" type="button" value="Importar Financeiros" name="Importar Financeiros" />
    </a>
</div>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
        @forelse ($financeiros as $financeiro)
        <tr>
            <td class="text-left">{{ $financeiro->RAZAO }}</td>
            <td class="text-left">{{ $financeiro->VR_TOTAL }}</td>
            <td class="text-left">{{ $financeiro->VR_PAGO }}</td>
            <td class="text-left">{{ $financeiro->DT_EMISSAO }}</td>
            <td class="text-left">{{ $financeiro->DT_VENCTO }}</td>
            <td class="text-left">{{ $financeiro->DT_PAGTO }}</td>
            <td class="text-left">{{ $financeiro->STATUS }}</td>
            <td class="text-left">
                @if ($financeiro->importar == 1)
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"> Importar</span>
                @endif
                @if ($financeiro->importar == 0)
                <span style="color:red" class="fas fa-ban" aria-hidden="true"> Cadastrado</span>
                @endif
                @if ($financeiro->importar == 2)
                <span style="color:orange" class="fas fa-ban" aria-hidden="true"> Importado</span>
                @endif
            </td>
        </tr>
        @empty
        @endforelse
</x-adminlte-datatable>

@stop