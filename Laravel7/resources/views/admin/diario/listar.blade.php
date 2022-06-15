@extends('adminlte::page')

@section('content_header')
<h1>Listar Diarios</h1>
@stop

@section('content')

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center">Nome</th>
            <th class="text-center">Ano</th>
            <th class="text-center">Período</th>
            <th class="text-center">Observação</th>
            <th class="text-center">Status</th>
            <th class="text-center" colspan="3">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($diario as $diario): ?>
            <tr <?php if ($diario->status == "0") echo "style=\"color:gray\""; ?> >
                <td class="text-center"><a href="/diario/ficha/<?= $diario->id ?>" title='Ficha do Diario'><?php echo $diario->nome; ?></a></td>
                <td class="text-center"><?php echo $diario->ano; ?></td>
                <td class="text-center">
                    <?php
                    if ($diario->periodo == 'M')
                        echo 'Matutino';
                    if ($diario->periodo == 'V')
                        echo 'Vespertino';
                    if ($diario->periodo == 'E')
                        echo 'Extendido';
                    if ($diario->periodo == 'I')
                        echo 'Integral';
                    ?>
                </td>
                <td class="text-center"><?php echo $diario->observacoes; ?></td>
                <td class="text-center">
                    <?php
                    if ($diario->status == 1)
                        echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
                    else
                        echo'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
                    ?>
                </td>

                <td>
                    <a href="/diario/editar/<?= $diario->id ?>" title='Editar as Informações do Diario'>
                        <span style="color:orange" class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                </td>
                <td>
                    <?php if ($diario->status == "0") { ?> 
                        <a href="/diario/ativar/<?= $diario->id ?>" title='Ativa o Diario'>
                            <span style="color:green" class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        </a>
                    <?php } else { ?>
                        <a href="/diario/bloquear/<?= $diario->id ?>" title='Bloqueia o Diario'>
                            <span style="color:red" class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </a>
                    <?php } ?>
                </td>
                <td>
                    <a href="/diario/apagar/<?= $diario->id ?>" title='Apaga o Diario'>
                        <span style="color:red" class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

@stop