@extends('adminlte::page')

@section('content_header')
<h1>Ficha do Animal</h1>
@stop

@section('content')
<div class="box box-success box-solid box-footer" >
    <div class="form-row col-sm-6">
        <label class="control-label col-sm-6" for='animal_nome'>Nome do Animal:</label>
        <span class="col-sm-6">{{ $inseminacao[0]->nome}}</span>
    </div>
    <div class="form-row col-sm-6">
        <label class="control-label col-sm-6" for='animal_numero'>Número do Animal:</label>
        <span class="col-sm-6">{{ $inseminacao[0]->numero}}</span>
    </div>
    <div class="form-row col-sm-6">
        <label class="control-label col-sm-6" for='animal_nascimento'>Data de Nascimento do Animal:</label>
        <span class="col-sm-6">{{ date('d/m/Y', strtotime($inseminacao[0]->nascimento))}}</span>
    </div>
    <div class="form-row col-sm-6">
        <label class="control-label col-sm-6" for='animal_sexo'>Sexo do Animal:</label>
        <span class="col-sm-6">{{ $inseminacao[0]->sexo}}</span>
    </div>
    <div class="form-row col-sm-6">
        <label class="control-label col-sm-6" for='animal_mae'>Nome da Mãe:</label>
        <span class="col-sm-6">{{ $inseminacao[0]->mae}}</span>
    </div>
    <div class="form-row col-sm-6">
        <label class="control-label col-sm-6" for='animal_pai'>Número do Pai:</label>
        <span class="col-sm-6">{{ $inseminacao[0]->pai}}</span>
    </div>
</div>
<h3>Inseminações</h3>
<table class="table table-striped table-hover table-responsive table-bordered">
    <thead>
        <tr>
            <th class="text-center">Animal</th>
            <th class="text-center">Data Inseminação</th>
            <th class="text-center">Turno Inseminação</th>
            <th class="text-center">Touro</th>
            <th class="text-center">Inseminador</th>
            <th class="text-center">Data Confirmação</th>
            <th class="text-center">Examinador</th>
            <th class="text-center">Fecundação</th>
            <th class="text-center">Data Parto</th>
            <th class="text-center">Acompanhante</th>
            <th class="text-center">Filhote</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($inseminacao as $inseminacao)
        <tr>
            <td class="text-center"><a href="/inseminacao/ficha/{{ $inseminacao->animal_id }}" title='Ficha do Animal'>{{ $inseminacao->nome}}</a></td>
            <td class="text-center">{{ date('d/m/Y', strtotime($inseminacao->datainseminacao)) }}</td>
            <td class="text-center">{{ $inseminacao->turno}}</td>
            <td class="text-center">{{ $inseminacao->touro}}</td>
            <td class="text-center">{{ $inseminacao->inseminador}}</td>
            <td class="text-center">{{ date('d/m/Y', strtotime($inseminacao->dataconfirmacao)) }}</td>
            <td class="text-center">{{ $inseminacao->examinador}}</td>
            <td class="text-center">
                @if ($inseminacao->status_gestacao == '0') <!--Aguardadno-->
                <span style="color:yellow" class="fas fa-clock" aria-hidden="true"></span>
                @endif
                @if ($inseminacao->status_gestacao == '1')  <!--Gestando-->
                <span style="color:green" class="fas fa-check" aria-hidden="true"></span>
                @endif
                @if ($inseminacao->status_gestacao == '2')  <!--Não fecundou ou finalizado-->
                <span style="color:red" class="fas fa-" aria-hidden="true"></span>
                @else
                @endif
            </td>
            <td class="text-center">{{date('d/m/Y', strtotime($inseminacao->dataparto))}}</td>
            <td class="text-center">{{ $inseminacao->acompanhante}}</td>
            <td class="text-center"><a href="/inseminacao/ficha/{{ $inseminacao->filhote_id }}" title='Ficha do Animal'>{{ $inseminacao->filhote_id}}</a></td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>



@stop