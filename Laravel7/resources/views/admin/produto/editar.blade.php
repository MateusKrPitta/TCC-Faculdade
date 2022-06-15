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
    <form class="needs-validation" name='FormularioEditarProduto' id='FormularioEditarProduto' action="/produto/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações do Produto' name='blocoform01' id='blocoform01'><legend>Informações do Produto</legend>

                <input type="hidden" name="acao" id="acao" value="Produtoeditar" />
                <input type="hidden" name="id" id="id" value='{{ $produto[0]->id }}' />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />


                <div class="form-row">
                    <div class="col-sm-5">
                        <label class="control-label col-sm-2" for='nome'>Nome</label>
                        <x-adminlte-input class="form-control" name='nome' type='text' size='90' title='Coloque o nome do Produto ' value="{{ $produto[0]->nome }}"/>
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label col-sm-9" for='codbarras'>Código de Barras</label>
                        <x-adminlte-input class="form-control" name='codbarras' type='number' size='999999999999999' title='Coloque o codigo de barras' value="{{ $produto[0]->codbarras }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-5">
                        <label class="control-label col-sm-4" for='valor'>Valor</label>
                        <x-adminlte-input class="form-control col-sm-4" name='valor' type='text' title='Informe o valor do Produto' value="{{ $produto[0]->valor }}"/>
                    </div>


                    <div class="col-sm-5">
                        <label class="control-label col-sm-4" for='quantidade'>Quantidade</label>
                        <x-adminlte-input class="form-control col-sm-4" name='quantidade' type='number'  size='999999999999999'title='Informe a quantidade de produtos' value="{{ $produto[0]->quantidade }}"/>
                    </div>
                </div>
                <div class="form-row">
                   <div class="col-sm-9">
                        <label class="control-label col-sm-2" for='observacao'>Observação</label>
                        <x-adminlte-textarea class="form-control col-sm-11" name='observacao' type='text' title='Informe uma observação sobre o Produto'>{{ $produto[0]->observacao }}</x-adminlte-textarea>
                    </div>

                </div>
                <br />

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