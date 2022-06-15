@extends('adminlte::page')

@section('content_header')
<h1>Ficha da Matrícula</h1>
@stop

@section('content')
<div class="d-none d-print-block">
    <img style="width: 1500px" src="/logo.jpg" />
</div>
<div class="box box-solid box-footer" >
    <h3>1. DADOS DE IDENTIFICAÇÃO DA TURMA</h3>
    <div class="box box-solid box-footer" >
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label class="control-label" for='matricula_nome'>Nome:</label>
                <span class="col-lg-2">{{ $matricula[0]->nome}}</span>
            </div>
            <div class="col-md-3 mb-3">
                <label class="control-label" for='ano'>ANO:</label>
                <span class="col-lg-2">{{ $matricula[0]->ano}}</span>
            </div>
            <div class="col-md-3 mb-3">
                <label class="control-label" for='periodo'>Período:</label>
                <span class="col-lg-2">

                    @if ($matricula[0]->periodo == 'M') Matutino @endif
                    @if ($matricula[0]->periodo == 'V') Vespertino @endif
                    @if ($matricula[0]->periodo == 'E') Extendido @endif
                    @if ($matricula[0]->periodo == 'I') Integral @endif

                </span>
            </div>
        </div>
    </div>

    <h3>2. PROFESSORES</h3>
    <div class="box box-solid box-footer" >
        <div class="form-row">



        </div>
    </div>

    <h3>3. ALUNOS</h3>
    <div class="box box-solid box-footer" >
        <div class="form-row">



        </div>
    </div>	

    <h3>4. OUTRAS INFORMAÇÕES</h3>
    <div class="box box-solid box-footer" >

        <div class="form-row">	
            <label class="control-label " for='observacoes'>Observações:</label>
            <span class="col-lg-10">{{ $matricula[0]->observacoes}}</span>
        </div>

    </div>

</div>


@stop