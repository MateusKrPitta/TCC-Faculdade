@extends('adminlte::page')

@section('content_header')
<h1>Listar Usuário</h1>
@stop

@section('content')


<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($usuarios as $usuario)
    <tr <?php if ($usuario->status == "0") echo "style=\"color:gray\""; ?> >
        <td>
            {{ $usuario->empresas_nome}}
        </td>
        <td>
            {{ $usuario->nome }}
        </td>
        <td>
            {{$usuario->email}}
        </td>
        <td>
            {{$usuario->perfils_nome}}
        </td>
        <td class="text-right">
            {{ $usuario->updated_at}}
        </td>
        <td class="text-center">
            @if ($usuario->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td>
            <a href="/usuarios/editar/{{ $usuario->id }}" title='Editar as Informações do Usuário'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @if ($usuario->status == "0") 
            <a href="/usuarios/ativar/{{ $usuario->id }}" title='Ativa o Usuário'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/usuarios/bloquear/{{ $usuario->id }}" title='Bloqueia o Usuário'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            <a href="/usuarios/apagar/{{$usuario->id }}" title='Apaga o Usuário'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop