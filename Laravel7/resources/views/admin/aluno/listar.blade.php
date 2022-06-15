@extends('adminlte::page')

@section('content_header')
<h1>Listar Alunos</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($alunos as $aluno)
    <tr @if ($aluno->status == "0")  style="color:gray"  @endif>
        <td class="text-left">{{$aluno->nome}}</td>
        <td class="text-left">{{$aluno->nomepai}}</td>
        <td class="text-left">{{$aluno->numerotelefonepai}}</td>
        <td class="text-left">{{$aluno->nomemae}}</td>
        <td class="text-center">{{$aluno->numerotelefonemae}}</td>
        <td class="text-center no-print">
            @if ($aluno->status == 1)
            <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/aluno/editar/{{ $aluno->id }}" title='Editar as Informações do Aluno'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($aluno->status == "0") 
            <a href="/aluno/ativar/{{ $aluno->id }}" title='Ativa o Aluno'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/aluno/bloquear/{{ $aluno->id }}" title='Bloqueia o Aluno'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/aluno/apagar/{{ $aluno->id }}" title='Apaga o Aluno'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty   
    @endforelse
</x-adminlte-datatable>

@stop