@extends('adminlte::page')

@section('content_header')
<h1>Ficha da Turma</h1>
@stop

@section('content')
<div class="d-none d-print-block">
    <img style="width: 1500px" src="/logo.jpg" />
</div>
<br>
<div class="box box-solid box-footer" >
    <h3>1. DADOS DE IDENTIFICAÇÃO DA TURMA</h3>
    <div class="box box-solid box-footer" >
        <div class="row">
            <div class="col-md-3 mb-2">
                <label class="control-label" for='turma_nome'>Nome:</label>
                <span class="col-lg-2">{{ $turma[0]->nome}}</span>
            </div>
            <div class="col-md-3 mb-2">
                <label class="control-label" for='ano'>ANO:</label>
                <span class="col-lg-2">{{ $turma[0]->ano}}</span>
            </div>
            <div class="col-md-3 mb-2">
                <label class="control-label" for='periodo'>Período:</label>
                <span class="col-lg-2">

                    @if ($turma[0]->periodo == 'M') Matutino @endif
                    @if ($turma[0]->periodo == 'V') Vespertino @endif
                    @if ($turma[0]->periodo == 'E') Extendido @endif
                    @if ($turma[0]->periodo == 'I') Integral @endif


                </span>
            </div>
        </div>
    </div>

    <h3>2. PROFESSORES</h3>
    <div class="box box-solid box-footer" >
        <div class="form-row">
            <div class="col-md-3 mb-2">
                <span class="col-lg-2">{{ "Sem Professor"}}</span>
            </div>
        </div>
    </div>

    <h3>3. ALUNOS</h3>
    <div class="box box-solid box-footer" >
        <div class="row">
            <div class="col-md-3 mb-2">
                @if (!$matriculas)
                <span class='col-lg-12'>Sem Alunos</span>
                @endif

                @forelse($matriculas as $matricula)
                <span class="col-lg-12"> {{ $matricula->aluno_nome }} </span> <br />
                @empty
                @endforelse

            </div>
        </div>	

        <h3>4. OUTRAS INFORMAÇÕES</h3>
        <div class="box box-solid box-footer" >

            <div class="form-row">
                <div class="col-md-3 mb-2 ">
                    <label class="control-label col-lg-2" for='observacoes'>Observações:</label>
                    <br />
                    <span class="col-lg-10">{{$turma[0]->observacoes}}</span>
                </div>
            </div>

        </div>

    </div>


    @stop