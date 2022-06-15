@extends('adminlte::page')

@section('content_header')
<h1>Listar Empresas </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
        @forelse ($empresas as $empresa)
        <tr>
            <td class="text-left">{{ $empresa->nome}}</td>
            <td class="text-left">{{ $empresa->razaosocial }}</td>
            <td class="text-left">{{ $empresa->cpfcnpj}}</td>
            <td class="text-left">{{ $empresa->rgie}} </td>
            <td class="text-center">
                @if ($empresa->status == 1)
                <span class="fas fa-check-square" aria-hidden="true"></span>
                @else
                <span class="fas fa-ban" aria-hidden="true"></span>
                @endif
            </td>
            <td>
                <a href="/empresa/editar/{{ $empresa->id }}" title='Editar as Informações do Empresa'>
                    <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
                </a>
                @if ($empresa->status == "0") { ?> 
                <a href="/empresa/ativar/{{$empresa->id }}" title='Ativa a Empresa'>
                    <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
                </a>
                @else
                <a href="/empresa/bloquear/{{$empresa->id }}" title='Bloqueia a Empresa'>
                    <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
                </a>
                @endif
                <a href="/empresa/apagar/{{$empresa->id }}" title='Apaga a Empresa'>
                    <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
                </a>
            </td>
        </tr>
        @empty
        @endforelse
</x-adminlte-datatable>

@stop