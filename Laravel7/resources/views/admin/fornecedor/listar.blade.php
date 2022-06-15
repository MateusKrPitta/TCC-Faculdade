@extends('adminlte::page')

@section('content_header')
<h1>Listar Fornecedores</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($fornecedores as $fornecedor)
    <tr>
        <td class="text-left">{{ $fornecedor->nome}}</td>
        <td class="text-left">{{ $fornecedor->razaosocial}}</td>
        <td class="text-left">{{ $fornecedor->cpfcnpj}}</td>
        <td class="text-left">{{ $fornecedor->rgie}}</td>
        <td class="text-left ">{{ implode('/', array_reverse(explode('-', $fornecedor->nascimento)))}}</td>
        <td class="text-center">
            @if ($fornecedor->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td>
            <a href="/fornecedor/editar/{{ $fornecedor->id }}" title='Editar as Informações do Fornecedor'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($fornecedor->status == "0")
            <a href="/fornecedor/ativar/{{  $fornecedor->id }}" title='Ativa o Fornecedor'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/fornecedor/bloquear/{{ $fornecedor->id }}" title='Bloqueia o Fornecedor'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/fornecedor/apagar/{{$fornecedor->id }}" title='Apagar o Fornecedor'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop