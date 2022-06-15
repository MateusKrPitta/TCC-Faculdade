@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} </div>
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




<div class=" col-md-12">
    <!--Formulario-->
    <form class="needs-validation" name='FormularioCadastrarAlimento' id='FormularioCadastrarAlimento' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >
        <div>
            <fieldset title='Informações da Alimento' name='blocoform01' id='blocoform01'><legend>Informações do Alimento</legend>

                <input type="hidden" name="acao" id="acao" value="Alimentonovogravar" />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
                <input type="hidden" name="usuario_id" id="usuario_id" value="{{$usuario_id}}" />

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label class="control-label col-md-2" for='nome'>Nome</label>
                        <x-adminlte-input class="form-control col-md-4" name='nome' type='text' size='50' title='Coloque o nome para identificação do Alimento/Ração' value="{{ $errors->all() ? old('nome') : '' }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label class="control-label col-md-2" for='composicao'>Composição</label>
                        <x-adminlte-textarea rows="5" class="form-control" name='composicao' title='Ingredientes utilizados na produção da ração'>{{ $errors->all() ? old('observacoes') : '' }}</x-adminlte-textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label class="" for='peso'>Peso (kg)</label>
                        <x-adminlte-input class="form-control" name='peso' type='number' step='0.01' size='50' title='Informe o total adquirido em quilogramas' value="{{ $errors->all() ? old('peso') : '' }}"/>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label class="control-label col-md-4" for='valor'>Valor (R$)</label>
                        <x-adminlte-input class="form-control col-md-4" name='valor' type='number' step='0.01' size='50' title='Informe o valor pago pelo total da alimentação/ração' value="{{ $errors->all() ? old('valor') : '' }}"/>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label class="" for='inicio'>Início do Consumo</label>
                        <x-adminlte-input class="form-control" name='inicio' type='date'  title='Informe a data do ínício do consumo' value="{{ $errors->all() ? old('inicio') : '' }}"/>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="" for='fim'>Fim do Consumo</label>
                        <x-adminlte-input class="form-control" name='fim' type='date'  title='Informe a data do fim do consumo' value="{{ $errors->all() ? old('fim') : '' }}"/>
                    </div>
                    <input type="hidden" name="status" id="status" value="1" />
                </div>
                
                <br/>
                <div class="form-row">
                    <div class="control-label col-md-4" >
                        <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                    
                </div>

            </fieldset>
        </div>
    </form>
</div>

@stop