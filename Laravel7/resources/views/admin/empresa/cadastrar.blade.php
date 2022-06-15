@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} - {{ old('razaosocial') }}</div>
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

    <form class="needs-validation" name='FormularioCadastrarEmpresa' id='FormularioCadastrarEmpresa' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações do Empresa' name='blocoform01' id='blocoform01'><legend>Informações do Empresa</legend>

                <input type="hidden" name="acao" id="acao" value="Empresanovogravar" />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />

                <div class="form-row">
                    <div class="col-sm-10">
                        <label class="control-label col-sm-2" for='nome'>Nome</label>
                        <x-adminlte-input class="form-control" name='nome' type='text' size='90' title='Coloque o nome do Empresa ou o Nome Fantasia' value="{{ $errors->all() ? old('nome') : '' }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-10">
                        <label class="control-label col-sm-2" for='razaosocial'>Razão Social</label>           
                        <x-adminlte-input class="form-control" name='razaosocial' type='text' size='90' title='Coloque o nome da razão social' value="{{ $errors->all() ? old('razaosocial') : '' }}"/>
                    </div>
                </div>

                <div class="form-row">           
                    <div class="col-sm-6">
                        <label class="control-label col-sm-3" for='cpfcnpj'>CPF ou CNPJ</label>
                        <x-adminlte-input class="form-control col-sm-12" name='cpfcnpj' type='number' size='999999999999999' title='Informe o número do CPF ou do CNPJ' value="{{ $errors->all() ? old('cpfcnpj') : '' }}"/>
                    </div>

                    <div class="col-sm-6">
                        <label class="control-label col-sm-5" for='rgie'>RG ou Inscrição Estadual</label>
                        <x-adminlte-input class="form-control col-sm-12" name='rgie' type='text'  title='Informe o número do RG ou Inscrição Estadual' value="{{ $errors->all() ? old('rgie') : '' }}"/>
                    </div>
                </div>

                <input type="hidden" name="status" id="status" value="1" />

                <br/> 
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