@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('password'))<!-- comment -->
<div class="alert alert-danger">
    <ul>
        <li>A senha atual ou a confirmação da nova senha estão incorretas.</li>
        <li>Os dados não foram gravados</li>
    </ul>
</div>

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

<div class=" col-sm-12">
    <!--Formulario-->
    <form class="needs-validation" name='formulariousuario' id='formulariousuario' action="/usuarios/atualizarsenha" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Senha do Usuário' name='blocoform01' id='blocoform01'><legend>Senha do Usuário</legend>

            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="control-label" for='password'>Senha Atual</label>
                    <x-adminlte-input class="form-control" name='password' type='password' size='50' title='Coloque a senha atual do Usuário' value="" />
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="control-label" for='password1'>Nova Senha</label>
                    <x-adminlte-input class="form-control" name='password1' type='password' size='50' title='Coloque a nova senha do Usuário' value="" />
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="control-label" for='password2'>Confirmação da Nova Senha</label>
                    <x-adminlte-input class="form-control" name='password2' type='password' size='50' title='Coloque a nova senha do Usuário' value="" />
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="control-label col-sm-3" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>
        </fieldset>


    </form>
</div>


@stop