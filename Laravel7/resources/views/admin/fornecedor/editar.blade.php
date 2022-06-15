@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} - CPF: {{ old('cpfcnpj') }} </div>
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
    <form class="needs-validation" name='FormularioEditarFornecedor' id='FormularioEditarFornecedor' action="/fornecedor/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Fornecedor' name='blocoform01' id='blocoform01'><legend>Informações do Fornecedor</legend>

            <x-adminlte-input type="hidden" name="acao" id="acao" value="Fornecedoreditar" />
            <x-adminlte-input type="hidden" name="id" id="id" value="{{ $fornecedor->id }}" />
            <x-adminlte-input type="hidden" name="empresa_id" id="empresa_id" value="{{ $fornecedor->empresa_id }}" />
            <x-adminlte-input type="hidden" name="usuario_id" id="usuario_id" value="{{ $fornecedor->usuario_id }}" />
            <x-adminlte-input type="hidden" name="_token" value=" {{ csrf_token() }} " />

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label class="" for='nome'>Nome</label>
                    <x-adminlte-input class="form-control" name='nome' type='text' title='Coloque o nome do Fornecedor' value="{{ $fornecedor->nome }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='cpfcnpj'>CPF</label>
                    <x-adminlte-input class="form-control" name='cpfcnpj' type='text' title='Informe o número do CPF ou do CNPJ' value="{{ $fornecedor->cpfcnpj }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='rgie'>RG</label>
                    <x-adminlte-input class="form-control" name='rgie' type='text' title='Informe o número do RG ou Inscrição Estadual' value="{{ $fornecedor->rgie }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>

            </div>
            <div class="form-row">
                  
                <div class="col-md-6 mb-3">
                    <label class="" for='razaosocial'>Razão Social (Apenas para empresas)</label>
                    <x-adminlte-input class="form-control" name='razaosocial' type='text' title='Informe a Razão Social' value="{{ $fornecedor->razaosocial }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="" for='email'>Email</label>
                    <x-adminlte-input class="form-control" name='email' type='text' title='Informe o Email' value="{{ $fornecedor->email }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='nascimento'>Data de Abertura / Nascimento</label>
                    <x-adminlte-input class="form-control" name='nascimento' type='date' title='Informe a data do nascimento do Fornecedor ou a data de nascimento da Empresa' value="{{ $fornecedor->nascimento }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <label class="" for='tel1'>Telefone 1</label>
                    <x-adminlte-input class="form-control" name='tel1' type='text' title='Informe o número do Telefone' value="{{$fornecedor->tel1}}" />
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='tel2'>Telefone 2</label>
                    <x-adminlte-input class="form-control" name='tel2' type='text' title='Informe o número do Telefone' value="{{$fornecedor->tel2}}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">

                <div class="col-md-4 mb-3">
                    <label class="" for='logradouro'>Endereço</label>
                    <x-adminlte-input class="form-control" name='logradouro' type='text'  title='Informe o nome do Logradouro' value="{{$fornecedor->logradouro}}" placeholder="Rua" />
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-1 mb-3">
                    <label class="" for='numero'>Número</label>
                    <x-adminlte-input class="form-control" name='numero' type='text' title='Informe o número do Endereço' value="{{$fornecedor->numero}}" />
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='bairro'>Bairro</label>
                    <x-adminlte-input class="form-control" name='bairro' type='text'  title='Informe o nome do Bairro' value="{{$fornecedor->bairro}}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="" for='complemento'>Complemento</label>
                    <x-adminlte-input class="form-control" name='complemento' type='text'  title='Informe o complemento' value="{{$fornecedor->complemento}}" />
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-5 mb-3">
                    <label class="" for='cidade'>Cidade</label>
                    <x-adminlte-input class="form-control" name='cidade' type='text'  title='Informe o nome da Cidade' value="{{$fornecedor->cidade}}" />
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-1 mb-3">
                    <label class="" for='estado'>Estado</label>
                    <x-adminlte-input class="form-control" name='estado' type='text'  title='Informe a sigla do Estado' value="{{$fornecedor->estado}}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                                
                <div class="col-md-2 mb-3">
                    <label class="" for='cep'>CEP</label>
                    <x-adminlte-input class="form-control" name='cep' type='number'  title='Informe o cep' value="{{$fornecedor->cep}}" />
                    <div class="valid-feedback">Certo!</div>
                </div>

            </div>
            <hr />
            <div class="form-row">
                <div class="col-md-5 mb-3">
                    <label class="" for='contatonome'>Nome para Contato</label>
                    <x-adminlte-input class="form-control" name='contatonome' type='text'  title='Informe nome para Contato' value="{{$fornecedor->contatonome}}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <label class="" for='contatotelefone'>Telefone para Contato</label>
                    <x-adminlte-input class="form-control" name='contatotelefone' type='number'  title='Informe o Telefone para Contato' value="{{$fornecedor->contatotelefone}}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="" for='contatoemail'>Email para Contato</label>
                    <x-adminlte-input class="form-control" name='contatoemail' type='text'  title='Informe o Email para Contato' value="{{$fornecedor->contatoemail}}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label class="" for='observacoes'>Observações</label>
                    <x-adminlte-textarea rows="5" cols="100" class="form-control" name='observacoes' title='Informe as Observações'>{{$fornecedor->observacoes}}</x-adminlte-textarea>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            <hr />

            <div class="form-row">
                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>

    </form>

</div>

@stop