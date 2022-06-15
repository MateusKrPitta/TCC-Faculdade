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
    <form class="needs-validation" name='FormularioEditarProjeto' id='FormularioEditarProjeto' action="/projeto/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Projeto' name='blocoform01' id='blocoform01'><legend>Informações do Projeto</legend>

            <input type="hidden" name="acao" id="acao" value="Projetoeditar" />
            <input type="hidden" name="id" id="id" value='{{ $projeto[0]->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label class="" for='nome'>Nome</label>
                    <x-adminlte-input class="form-control" name='nome' type='text' size='90' title='Coloque o nome da forma de pagamento' value="{{ $projeto[0]->nome }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='parcela'>Parcela</label>
                    <x-adminlte-input class="form-control" name='parcela' type='number' title='Informe o número de parcelas' value="{{ $projeto[0]->parcela }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='planodecontas_id'>Plano de Contas</label>
                    <x-adminlte-input class="form-control" name='planodecontas_id' type='number'  title='Informe o plano de contas' value="{{ $projeto[0]->planodecontas_id }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            

            <div class="form-group">
                <label class="control-label col-sm-1" for='status'>Status</label>
                <div  class="col-sm-4">
                    <x-adminlte-select2 class="form-control" name="status" title='Escolha o status' >
                        <option value="1"{{ $projeto[0]->status == "1" ? ' selected' : '' }}>Ativo</option> 
                        <option value="0"{{ $projeto[0]->status == "0" ? ' selected' : '' }}>Inativo</option> 
                    </x-adminlte-select2>
                </div>
            </div>


            <div class="form-group">

                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>

    </form>

</div>

@stop