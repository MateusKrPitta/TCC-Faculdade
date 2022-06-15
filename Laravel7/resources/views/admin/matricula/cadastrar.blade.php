@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('valor_mensalidade'))
@if(!$errors->all())
<div class="alert alert-success"> Matriculado {{ old('observacoes') }} </div>
@endif
@if($errors->all())
<div class="alert alert-danger">
    <ul>
        @forelse($errors->all() as $mensagemerro)
        <li>{{$mensagemerro}}</li>
        @empty
        @endforelse
        <li>Os dados não foram gravados</li>
    </ul>
</div>
@endif
@endif

<div class=" col-sm-12">
    <!--Formulario-->
    <form class="needs-validation" name='FormularioCadastrarMatricula' id='FormularioCadastrarMatricula' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações da Matricula' name='blocoform01' id='blocoform01'><legend>Informações do Matricula</legend>

                <input type="hidden" name="acao" id="acao" value="Matriculanovogravar" />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
                <input type="hidden" name="status" id="status" value="1" />
                <input type="hidden" name="usuario_id" id="usuario_id" value="{{$id_usuario}}" />

                <div class="form-row">

                    <div class="col-md-3 mb-2">
                        <label class="" for='aluno_id'>Aluno</label>                  
                        <x-adminlte-select2 name="aluno_id" class="form-control">
                            @forelse($alunos as $aluno)
                            <option value="{{ $aluno->id }}">{{ $aluno->nome }} - {{ $aluno->nomemae }}</option>
                            @empty
                            <option value=""> Cadastre um Aluno </option>
                            @endforelse
                        </x-adminlte-select2>
                    </div>

                    <div class="col-md-3 mb-2">
                        <label class="" for='turma_id'>Turma</label>
                        <x-adminlte-select2 name="turma_id" class="form-control">
                            @forelse($turmas as $turma)
                            <option value="{{ $turma->id }}">{{ $turma->nome }} - {{ $turma->ano }} 

                                @if ($turma->periodo == 'M') Matutino @endif                                  
                                @if ($turma->periodo == 'V') Vespertino @endif                                  
                                @if ($turma->periodo == 'E') Extendido  @endif                       
                                @if ($turma->periodo == 'I') Integral @endif

                            </option>
                            @empty
                            <option value=""> Cadastre uma Turma </option>
                            @endforelse
                        </x-adminlte-select2>
                    </div>
                    <div class="col-sm-3">
                        <label class="" for='valor_matricula'>Matrícula R$</label>
                        <x-adminlte-input class="form-control" name='valor_matricula' type='text' size='10' title='Coloque o valor da Matricula' value="{{ $errors->all() ? old('valor_matricula') : '' }}"/>
                    </div>

                    <div class="col-sm-3">
                        <label class="" for='valor_mensalidade'>Mensalidade R$</label>
                        <x-adminlte-input class="form-control" name='valor_mensalidade' type='text' size='10' title='Coloque o valor da Mensalidade' value="{{ $errors->all() ? old('valor_mensalidade') : '' }}"/>
                    </div>
                </div>


                <div class="form-row">

                    <div class="col-sm-12">
                        <label class="control-label col-sm-2" for='observacoes'>Observações</label>
                        <x-adminlte-textarea class="form-control col-sm-12" name='observacoes' type='text' size='50' rows="5" cols="33"  title='Coloque detalhes adicionais'>{{ $errors->all() ? old('observacao') : '' }}</x-adminlte-textarea>
                    </div>
                </div>
            </fieldset>


            <br />
            <div class="form-row">
                <div class="control-label col-sm-4" ></div>
                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>


        </div>
    </form>
</div>


@stop