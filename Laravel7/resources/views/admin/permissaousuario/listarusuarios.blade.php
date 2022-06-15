@extends('adminlte::page')

@section('content_header')
<h1>Listar Usuarios </h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @foreach($usuarios as $usuario)
    <tr>
        <td class="text-left">
            {{$usuario->empresas_nome}}
        </td>
        <td class="text-left">
            {{$usuario->nome}}
        </td>
        <td class="text-left">
            {{$usuario->email}}
        </td>
        <td class="text-left">
            {{$usuario->perfils_nome}}
        </td>
        <td class="text-center">
            @if ($usuario->status == 1)
                <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
                <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>
        <td>
            <a href="/usuarios/editar/<?= $usuario->id ?>" title='Editar as Informações do Usuario'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            <?php if ($usuario->status == "0") { ?> 
                <a href="/usuarios/ativar/<?= $usuario->id ?>" title='Ativa o Usuario'>
                    <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
                </a>
            <?php } else { ?>
                <a href="/usuarios/bloquear/<?= $usuario->id ?>" title='Bloqueia o Usuario'>
                    <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
                </a>
            <?php } ?>
            <a href="/permissaousuario/listar/<?= $usuario->id ?>" title='Acessos do Usuario'>
                <span style="color:blue" class="fas fa-lock" aria-hidden="true"></span>
            </a>
        </td>

    </tr>
    @endforeach

</x-adminlte-datatable>

@stop