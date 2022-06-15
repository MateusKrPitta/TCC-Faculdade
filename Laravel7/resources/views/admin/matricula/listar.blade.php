@extends('adminlte::page')

@section('content_header')
<h1>Listar Matriculas</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($matriculas as $matricula)
    <tr @if ($matricula->status == "0") style="color:gray"" @endif >
        <td class="text-left"><a href="/aluno/ficha/{{ $matricula->aluno_id }}" title='Ficha do Aluno'>{{ $matricula->aluno_nome}}</a></td>
        <td class="text-left">
            <a href="/turma/ficha/{{ $matricula->turma_id }}" title='Ficha do Turma'>
                {{ $matricula->turma_nome}}
            </a>
        </td>
        <td class="text-left">
            <a href="/turma/ficha/{{$matricula->turma_id }}" title='Ficha do Turma'>
                {{ $matricula->turma_ano . " - "}}
                @if ($matricula->turma_periodo == 'M') Matutino @endif
                @if ($matricula->turma_periodo == 'V') Vespertino @endif
                @if ($matricula->turma_periodo == 'E') Extendido @endif
                @if ($matricula->turma_periodo == 'I') Integral @endif
            </a>
        </td>
        <td class="text-left">{{$matricula->observacoes}}</td>
        <td class="text-center">
            @if ($matricula->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @endif
            <a href="/matricula/editar/{{$matricula->id }}" title='Editar as Informações do Matricula'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($matricula->status == "0") 
            <a href="/matricula/ativar/{{$matricula->id}}" title='Ativa o Matricula'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/matricula/bloquear/{{$matricula->id }}" title='Bloqueia a Matricula'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop