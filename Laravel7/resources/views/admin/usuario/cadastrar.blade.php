@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }}</div>
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
    <form class="needs-validation" name='formulariousuario' id='formulariousuario' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >
        <fieldset title='Informações do Usuário' name='blocoform01' id='blocoform01'><legend>Informações do Usuário</legend>
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='name'>Nome</label>
                    <x-adminlte-input class="form-control" name='name' type='text' size='50' title='Coloque o nome do Usuário' value="{{ $errors->all() ? old('name') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='email'>E-mail</label>
                    <x-adminlte-input class="form-control" name='email' type='text' size='50' title='Coloque o Email do Usuário' value="{{ $errors->all() ? old('email') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="control-label" for='password'>Senha</label>
                    <input type="hidden" name="senhaantiga" value="" />
                    <x-adminlte-input class="form-control" name='password' type='password' size='50' title='Coloque a senha do Usuário' value='' />
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="control-label col-sm-1" for='empresa_id'>Empresa</label>
                    <x-adminlte-select2 class="form-control" name="empresa_id" title='Escolha a empresa'>
                        @forelse($empresas as $empresa)
                        <option value="{{$empresa->id}}" >{{$empresa->nome}}</option>
                        @empty
                        @endforelse
                    </x-adminlte-select2>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label class="control-label col-sm-1" for='perfil_id'>Perfil</label>
                    <x-adminlte-select2 class="form-control" name="perfil_id" title='Escolha o perfil do Usuário'>
                        @forelse($perfis as $perfil)
                        <option value="{{$perfil->id}}" >{{$perfil->nome}}</option>
                        @empty
                        @endforelse
                    </x-adminlte-select2>
                </div>

                <div class="col-md-1 mb-3">
                    <label class="control-label col-sm-1" for='status'>Status</label>
                    <x-adminlte-select2 class="form-control" name="status" title='Escolha o status do Usuário' >
                        <option value="1" >Ativo</option> 
                        <option value="0" >Inativo</option> 
                    </x-adminlte-select2>
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