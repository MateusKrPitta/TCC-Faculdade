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




<div class=" col-sm-12">
	<!--Formulario-->
	<form class="needs-validation" name='FormularioCadastrarAlimento' id='FormularioCadastrarAlimento' action="/alimento/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

		<div>
            <fieldset title='Informações da Alimento' name='blocoform01' id='blocoform01'><legend>Informações da Alimentação</legend>

                <input type="hidden" name="acao" id="acao" value="Alimentonovogravar" />
                <input type="hidden" name="id" id="id" value='{{ $alimento[0]->id }}' />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />

                <div class="form-row">
                    <div class="col-sm-3 mb-3">
                        <label class="control-label col-sm-2" for='nome'>Nome</label>
			<x-adminlte-input class="form-control col-sm-4" name='nome' type='text' size='50' title='Coloque o nome para identificação da  Alimentação/Ração' value="{{ $alimento[0]->nome }}"/>
                    </div>
		</div>
				
                <div class="form-row">
                    <div class="col-sm-10  mb-3">
			<label class="control-label col-sm-2" for='composicao'>Composição</label>
			<x-adminlte-textarea class="form-control" name='composicao' title='Ingredientes utilizados na produção da ração'>{{ $alimento[0]->composicao }}</x-adminlte-textarea>
                    </div>
                </div>
				
		<div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label class="" for='peso'>Peso (kg)</label>
			<x-adminlte-input class="form-control" name='peso' type='number' step='0.01' size='50' title='Informe o total adquirido em quilogramas' value="{{ $alimento[0]->peso }}"/>
                    </div>
                
                    <div class="col-md-2 mb-3">
			<label class="" for='valor'>Valor (R$)</label>
			<x-adminlte-input class="form-control" name='valor' type='number' step='0.01' size='50' title='Informe o valor pago pelo total da alimentação/ração' value="{{ $alimento[0]->valor }}"/>
                    </div>
                    <div class="col-md-3 mb-3">
			<label class="" for='inicio'>Início do Consumo</label>
			<x-adminlte-input class="form-control" name='inicio' type='date'  title='Informe a data do ínício do consumo' value="{{ $alimento[0]->inicio }}"/>
                    </div>
                    <div class="col-sm-5">
			<label class="control-label col-sm-9" for='fim'>Fim do Consumo</label>
			<x-adminlte-input class="form-control col-sm-5" name='fim' type='date'  title='Informe a data do fim do consumo' value="{{ $alimento[0]->fim }}"/>
                    </div>
                    <input type="hidden" name="status" id="status" value="{{ $alimento[0]->status }}" />
		</div>
                
		<div class="form-row">
		<div class="col-md-6 mb-3" >
                    <div class="control-label col-sm-4" >
			<button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                    </div>
                    </div>
		</div>

			</fieldset>
		</div>
	</form>
</div>

@stop