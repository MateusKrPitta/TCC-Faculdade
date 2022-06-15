@extends('adminlte::page')

@section('content_header')
<h1>Listar Permissões - {{$usuario->name}}</h1>
@stop

@section('content')

<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse($permissoes as $permissao)
    <tr>
        <td class="text-left"> {{$permissao->descricao}}
            <?php
            $consulta_id = 0;
            foreach ($permissoesdousuario as $pu) {
                if ($permissao->id == $pu->permissao_id)
                    $consulta_id = $permissao->id;
            }
            ?>
        </td>
        <td class="text-left"> 
            {{$permissao->grupo}}
        </td>
        <td class="text-center">
            <?php if ($permissao->id == $consulta_id) { ?> 
                <a href="/permissaousuario/bloquear/<?= $permissao->id ?>a{{$usuario->id}}" title='Bloqueia'>
                    <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
                </a>
            <?php } else { ?>
                <a href="/permissaousuario/ativar/<?= $permissao->id ?>a{{$usuario->id}}" title='Ativa'>
                    <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
                </a>
            <?php } ?>
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop