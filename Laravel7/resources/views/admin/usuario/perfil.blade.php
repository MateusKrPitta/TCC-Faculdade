@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

<div class=" col-sm-12">
    <!--Formulario-->
    <form class="needs-validation" name='formulariousuario' id='formulariousuario' action="/usuarios/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Perfil do Usuário' name='blocoform01' id='blocoform01'><legend>Perfil do Usuário</legend>

            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />

            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label class="" for='name'>Nome</label>
                    <x-adminlte-input class="form-control" name='name' type='text' size='50' title='Coloque o nome do Usuário' value="{{ $errors->all() ? old('name') : $usuario->name }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label class="" for='email'>E-mail</label>
                    <x-adminlte-input class="form-control" name='email' type='text' size='50' title='Coloque o Email do Usuário' value="{{ $errors->all() ? old('email') : $usuario->email }}"/>
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