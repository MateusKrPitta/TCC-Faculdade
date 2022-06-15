@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} kg</div>
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
    <form class="needs-validation" name='FormularioEditarExame' id='FormularioEditarProduto' action="/exame/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações do Exame' name='blocoform01' id='blocoform01'><legend>Informações do Exame</legend>

                <input type="hidden" name="acao" id="acao" value="Exameeditar" />
                <input type="hidden" name="id" id="id" value='{{ $exames[0]->id }}' />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
                <input type="hidden" name="empresa_id" value="2" />
                <input type="hidden" name="usuario_id" value="2" />

                <div class="form-row">                             	
                    <div class="col-md-4 mb-4">
                        <label class="control-label col-sm-2" for='nome'>Exame</label>
                        <x-adminlte-input class="form-control" name='nome' type='text' size='90' title='Coloque o nome do Exame' value="{{ $exames[0]->nome }}" />
                    </div>

                    <div class="col-md-2 mb-4">
                        <label class="control-label col-sm-2" for='valor'>Valor</label>
                        <x-adminlte-input class="form-control" name='valor' type='numer' size='9999999999' title='Coloque valor' value="{{ $exames[0]->valor }}" />
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="" for='valor_referencia'>Valor de Referência</label>
                        <x-adminlte-input class="form-control" name='valor_referencia' type='text' size='30000000' title='COloque o valor de referencia' value="{{ $exames[0]->valor_referencia }}"/>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="" for='tempo'>Tempo</label>
                        <x-adminlte-input class="form-control" name='tempo' type='numer' title='Informe o Tempo do Exame' value="{{ $exames[0]->tempo }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>

                    <div  class="col-md-2 mb-3">
                        <label class="control-label col-sm-1" for='status'>Status</label>
                        <x-adminlte-select2 class="form-control" name="status" title='Escolha o status do Usuário' >
                            <option value="1"{{ $exames [0]->status == "1" ? ' selected' : '' }}>Ativo</option> 
                            <option value="0"{{ $exames [0]->status == "0" ? ' selected' : '' }}>Inativo</option> 
                        </x-adminlte-select2>
                    </div>
                </div>
        </div>


        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label class="" for='descricao'>Descrição</label>
                <x-adminlte-textarea rows="5" class="form-control" name='descricao' type='text' title='Coloque o nome do Exame'>{{ $exames[0]->descricao }}</x-adminlte-textarea>
                <div class="valid-feedback">Certo!</div>                                 
            </div>


        </div>

</div>
<div class="form-row">

    <div class="control-label col-sm-4" ></div>
    <div class="control-label col-sm-4" >
        <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
    </div>
</div>

</fieldset>
</div>
</form>

</div>

@stop