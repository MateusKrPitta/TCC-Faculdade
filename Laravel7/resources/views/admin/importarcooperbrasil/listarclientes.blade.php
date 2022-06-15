@extends('adminlte::page')

@section('content_header')
<div class="text-left">
    <h1>Listar Clientes</h1>
</div>
<div class="text-right">
    <a href="/importarcooperbrasil/importarclientes"> 
        <input style="background-color: lightblue" type="button" value="Importar Clientes" name="Importar Clientes" />
    </a>
</div>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
        @forelse ($clientes as $cliente)
        <tr>
            <td class="text-center">{{ $cliente->RAZAO }}</td>
            <td class="text-center">{{ $cliente->FANTASIA }}</td>
            <td class="text-center">{{ $cliente->CPF }}</td>
            <td class="text-center">{{ $cliente->CNPJ }}</td>
            <td class="text-center">{{ implode('/', array_reverse(explode('-', $cliente->DATA_NASCIMENTO)))}}</td>
            <td class="text-center">
                @if ($cliente->importar == 1)
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"> Importar</span>
                @endif
                @if ($cliente->importar == 0)
                <span style="color:red" class="fas fa-ban" aria-hidden="true"> Cadastrado</span>
                @endif
                @if ($cliente->importar == 2)
                <span style="color:orange" class="fas fa-ban" aria-hidden="true"> Importado</span>
                @endif
            </td>
        </tr>
        @empty
        @endforelse
</x-adminlte-datatable>




@stop