@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome_exame') }} kg</div>
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
    <form class="needs-validation" name='FormularioEditarEspecialidade' id='FormularioEditarEspecialidade' action="/especialidade/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações da Especialidade' name='blocoform01' id='blocoform01'><legend>Informações da Especialidade</legend>

                <input type="hidden" name="acao" id="acao" value="Especialidadeeditar" />
                <input type="hidden" name="id" id="id" value='{{ $especialidades[0]->id }}' />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
                <input type="hidden" name="empresa_id" value="2" />
                <input type="hidden" name="usuario_id" value="2" />

                <div class="form-row">                             	
                    <div class="col-md-3 mb-4">
                        <label class="control-label col-sm-2" for='nome'>Especialidade</label>
                        <x-adminlte-input class="form-control" name='nome' type='text' size='90' title='INforme a Especialidade' value="{{ $especialidades[0]->nome }}"/>
                    </div>


                    <div class="col-md-3 mb-6">
                        <label class="control-label col-sm-6" for='conselhoregional'>Conselho Regional</label>
                        <x-adminlte-input class="form-control" name='conselhoregional' type='text'  title='Informe Conselho Regional' value="{{ $especialidades[0]->conselhoregional }}"/>
                    </div>
                </div>           


        </div>
        <br/>
        <div class="form-row">

            <div class="control-label col-sm-3" ></div>
            <div class="control-label col-sm-3" >
                <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
            </div>
        </div>

        </fieldset>
</div>
</form>

</div>

@stop