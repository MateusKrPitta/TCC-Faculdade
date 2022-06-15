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
    <form class="needs-validation" name='FormularioEditarTelemarketingtransporte' id='FormularioEditarTelemarketingtransporte' action="/telemarketingtransporte/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Telemarketingtransporte' name='blocoform01' id='blocoform01'><legend>Informações do Telemarketingtransporte</legend>

            <input type="hidden" name="acao" id="acao" value="Telemarketingtransporteeditar" />
            <input type="hidden" name="id" id="id" value='{{ $telemarketingtransporte[0]->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="2" />
            <input type="hidden" name="usuario_id" value="2" />

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label class="" for='nome'>Nome</label>
                    <x-adminlte-input class="form-control" name='nome' type='text' size='90' title='Coloque o nome do Telemarketingtransporte ' value="{{ $telemarketingtransporte[0]->nome }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='cpfcnpj'>CPF</label>
                    <x-adminlte-input class="form-control" name='cpfcnpj' type='number' size='999999999999999' title='Informe o número do CPF ou do CNPJ' value="{{ $telemarketingtransporte[0]->cpfcnpj }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='rgie'>RG</label>
                    <x-adminlte-input class="form-control" name='rgie' type='text'  title='Informe o número do RG ou Inscrição Estadual' value="{{ $telemarketingtransporte[0]->rgie }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='nascimento'>Data de Nascimento</label>
                    <x-adminlte-input class="form-control" name='nascimento' type='date' size='10' title='Informe a data do nascimento do Telemarketingtransporte' value="{{ $telemarketingtransporte[0]->nascimento }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="control-label" for='sexo'>Sexo</label>
                    <x-adminlte-select2 class="form-control" name="sexo" title='Escolha o sexo do telemarketingtransporte' >
                        <option value='M' {{ $telemarketingtransporte[0]->sexo == "M" ? ' selected' : '' }} >Masculino</option>
                        <option value='F' {{ $telemarketingtransporte[0]->sexo == "F" ? ' selected' : '' }} >Feminino</option> 
                        <option value='O' {{ $telemarketingtransporte[0]->sexo == "O" ? ' selected' : '' }} >Outro</option> 
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='tel1'>Telefone 1</label>
                    <x-adminlte-input class="form-control" name='tel1' type='text' title='Informe o número do Telefone' value="{{$telemarketingtransporte[0]->tel1}}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='tel2'>Telefone 2</label>
                    <x-adminlte-input class="form-control" name='tel2' type='text' title='Informe o número do Telefone' value="{{$telemarketingtransporte[0]->tel2}}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">

                <div class="col-md-4 mb-3">
                    <label class="" for='logradouro'>Endereço</label>
                    <x-adminlte-input class="form-control" name='logradouro' type='text'  title='Informe o nome do Logradouro' value="{{$telemarketingtransporte[0]->logradouro}}" placeholder="Rua" />
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-1 mb-3">
                    <label class="" for='numero'>Número</label>
                    <x-adminlte-input class="form-control" name='numero' type='number' size='99999' title='Informe o número do Endereço' value="{{$telemarketingtransporte[0]->numero}}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='bairro'>Bairro</label>
                    <x-adminlte-input class="form-control" name='bairro' type='text'  title='Informe o nome do Bairro' value="{{$telemarketingtransporte[0]->bairro}}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='cidade'>Cidade</label>
                    <x-adminlte-input class="form-control" name='cidade' type='text'  title='Informe o nome da Cidade' value="{{$telemarketingtransporte[0]->cidade}}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-1 mb-3">
                    <label class="" for='estado'>Estado</label>
                    <x-adminlte-input class="form-control" name='estado' type='text'  title='Informe o nome do Estado' value="{{$telemarketingtransporte[0]->estado}}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

            </div>

            <div class="form-row">
                <label class="control-label col-sm-1" for='status'>Status</label>
                <div  class="col-sm-4">
                    <x-adminlte-select2 class="form-control" name="status" title='Escolha o status do Usuário' >
                        <option value="1"{{ $telemarketingtransporte[0]->status == "1" ? ' selected' : '' }}>Ativo</option> 
                        <option value="0"{{ $telemarketingtransporte[0]->status == "0" ? ' selected' : '' }}>Inativo</option> 
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