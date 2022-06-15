@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} ( Nº {{ old('numero') }} ) - Peso: {{ old('peso') }} kg</div>
@endif
@if($errors->all())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $mensagemerro)
        <li>{{$mensagemerro}}</li>
        @endforeach
        <li>Os dados não foram gravados</li>
    </ul>
</div>
@endif
@endif

<div class=" col-sm-12">
    <!--Formulario-->
    <form class="needs-validation" name='FormularioEditarPlano' id='FormularioEditarPlano' action="/plano/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Plano' name='blocoform01' id='blocoform01'><legend>Informações do Plano</legend>

            <input type="hidden" name="acao" id="acao" value="Planoeditar" />
            <input type="hidden" name="id" id="id" value='{{ $plano[0]->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label class="" for='nome'>Nome</label>
                    <x-adminlte-input class="form-control" name='nome' type='text' size='90' title='Informe o nome do Plano' value="{{ $plano[0]->nome }}"/>
                        <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-2">
                    <label class=""  for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='text' size='10' title='Coloque o valor do plano' value="{{ number_format($plano[0]->valor,2,',','.') }}"/>
                        <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-2">
                    <label class="" for='tempodeduracao'>Meses de duração</label>
                    <x-adminlte-input class="form-control" name='tempodeduracao' type='number' size='99999' title='Informe o tempo de duração do plano' value="{{ $plano[0]->tempodeduracao }}"/>
                        <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-2">
                    <label class="" for='quantidadedependentes'>Dependentes</label>
                    <x-adminlte-input class="form-control" name='quantidadedependentes' type='number' size='99999' title='Informe a quantidade de dependentes do plano' value="{{ $plano[0]->quantidadedependentes }}"/>
                        <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            <div class="form-row">
                <div  class="col-md-4 mb-4">
                    <label class="" for='status'>Status</label>
                    <x-adminlte-select2 class="form-control" name="status" title='Escolha o status do Usuário' >
                        <option value="1"{{ $plano[0]->status == "1" ? ' selected' : '' }}>Ativo</option> 
                        <option value="0"{{ $plano[0]->status == "0" ? ' selected' : '' }}>Inativo</option> 
                    </x-adminlte-select2>
                </div>
            </div>


            <div class="form-row">

                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>

    </form>

</div>

@stop