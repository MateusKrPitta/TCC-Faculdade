@extends('adminlte::page')

@section('content_header')
<h1>Listar Turmas</h1>
@stop

@section('content')


<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($turmas as $turma)
    <tr @if($turma->status == "0") style="color:gray"  @endif>
        <td class="text-left"><a href="/turma/ficha/{{ $turma->id }}" title='Ficha do Turma'>{{ $turma->nome}}</a></td>
        <td class="text-left">{{ $turma->ano}}</td>
        <td class="text-left">
            @if ($turma->periodo == 'M') Matutino @endif                        
            @if ($turma->periodo == 'V') Vespertino @endif               
            @if ($turma->periodo == 'E') Extendido @endif             
            @if ($turma->periodo == 'I') Integral @endif
        </td>
        <td class="text-center">
            @if ($turma->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td>
            <a href="/turma/editar/{{$turma->id}}" title='Editar as Informações do Turma'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($turma->status == "0")  
            <a href="/turma/ativar/{{ $turma->id }}" title='Ativa o Turma'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else                     
            <a href="/turma/bloquear/{{$turma->id}}" title='Bloqueia o Turma'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/turma/apagar/{{$turma->id}}" title='Apaga o Turma'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
        @empty   
        @endforelse
    </tr>
</x-adminlte-datatable>

@stop