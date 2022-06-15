@extends('adminlte::page')

@section('content_header')
<div class="text-left">
    <h1>Listar Fornecedores</h1>
</div>
<div class="text-right">
    <a href="/importarcooperbrasil/importarfornecedores"> 
        <input style="background-color: lightblue" type="button" value="Importar Fornecedores" name="Importar Fornecedores" />
    </a>
</div>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
        @forelse ($fornecedores as $fornecedor)
        <tr>
            <td class="text-center">{{ $fornecedor->RAZAO }}</td>
            <td class="text-center">{{ $fornecedor->CIDADE }}</td>
            <td class="text-center">{{ $fornecedor->CPF }}</td>
            <td class="text-center">{{ $fornecedor->CNPJ }}</td>
            <td class="text-center">{{ implode('/', array_reverse(explode('-', $fornecedor->DATA_CADASTRO)))}}</td>
            <td class="text-center">
                @if ($fornecedor->importar == 1)
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"> Importar</span>
                @endif
                @if ($fornecedor->importar == 0)
                <span style="color:red" class="fas fa-ban" aria-hidden="true"> Cadastrado</span>
                @endif
                @if ($fornecedor->importar == 2)
                <span style="color:orange" class="fas fa-ban" aria-hidden="true"> Importado</span>
                @endif
            </td>
        </tr>
        @empty
        @endforelse
</x-adminlte-datatable>

@stop