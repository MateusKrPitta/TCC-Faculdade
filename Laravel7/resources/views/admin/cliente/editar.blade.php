@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} </div>
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
    <form class="needs-validation" name='FormularioEditarCliente' id='FormularioEditarCliente' action="/cliente/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Cliente' name='blocoform01' id='blocoform01'><legend>Informações do Cliente</legend>

            <input type="hidden" name="acao" id="acao" value="Clienteeditar" />
            <input type="hidden" name="id" id="id" value='{{ $cliente->id }}' />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label class="" for='nome'>Nome</label>
                    <input class="form-control" name='nome' type='text' title='Coloque o nome do Cliente' value='{{ $cliente->nome }}' required>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='cpfcnpj'>CPF</label>
                    <input class="form-control" name='cpfcnpj' type='text' title='Informe o número do CPF ou do CNPJ' value='{{ $cliente->cpfcnpj }}' >
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='rgie'>RG</label>
                    <input class="form-control" name='rgie' type='text' title='Informe o número do RG ou Inscrição Estadual' value='{{ $cliente->rgie }}' >
                    <div class="valid-feedback">Certo!</div>
                </div>

            </div>
            <div class="form-row">
                  
                <div class="col-md-6 mb-3">
                    <label class="" for='razaosocial'>Razão Social (Apenas para empresas)</label>
                    <input class="form-control" name='razaosocial' type='text' title='Informe a Razão Social' value='{{ $cliente->razaosocial }}' >
                    <div class="valid-feedback">Certo!</div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="" for='email'>Email</label>
                    <input class="form-control" name='email' type='text' title='Informe o Email' value='{{ $cliente->email }}' >
                    <div class="valid-feedback">Certo!</div>
                </div>
                
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='nascimento'>Data de Nascimento</label>
                    <input class="form-control" name='nascimento' type='date' title='Informe a data do nascimento do Cliente' value='{{ $cliente->nascimento }}' >
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="control-label" for='sexo'>Sexo</label>
                    <select class="form-control" name="sexo" title='Escolha o sexo do cliente' >
                        <option value='M' {{ $cliente->sexo == "M" ? ' selected' : '' }} >Masculino</option>
                        <option value='F' {{ $cliente->sexo == "F" ? ' selected' : '' }} >Feminino</option> 
                        <option value='O' {{ $cliente->sexo == "O" ? ' selected' : '' }} >Outro</option> 
                    </select>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='tel1'>Telefone 1</label>
                    <input class="form-control" name='tel1' type='text' title='Informe o número do Telefone' value='{{$cliente->tel1}}' >
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='tel2'>Telefone 2</label>
                    <input class="form-control" name='tel2' type='text' title='Informe o número do Telefone' value='{{$cliente->tel2}}' >
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">

                <div class="col-md-4 mb-3">
                    <label class="" for='logradouro'>Endereço</label>
                    <input class="form-control" name='logradouro' type='text'  title='Informe o nome do Logradouro' value='{{$cliente->logradouro}}' placeholder="Rua" >
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-1 mb-3">
                    <label class="" for='numero'>Número</label>
                    <input class="form-control" name='numero' type='text' title='Informe o número do Endereço' value='{{$cliente->numero}}' >
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='bairro'>Bairro</label>
                    <input class="form-control" name='bairro' type='text'  title='Informe o nome do Bairro' value='{{$cliente->bairro}}' >
                    <div class="valid-feedback">Certo!</div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <label class="" for='complemento'>Complemento</label>
                    <input class="form-control" name='complemento' type='text'  title='Informe o complemento' value='{{$cliente->complemento}}' >
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-5 mb-3">
                    <label class="" for='cidade'>Cidade</label>
                    <input class="form-control" name='cidade' type='text'  title='Informe o nome da Cidade' value='{{$cliente->cidade}}' >
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-1 mb-3">
                    <label class="" for='estado'>Estado</label>
                    <input class="form-control" name='estado' type='text'  title='Informe a sigla do Estado' value='{{$cliente->estado}}' >
                    <div class="valid-feedback">Certo!</div>
                </div>
                
                <div class="col-md-2 mb-3">
                    <label class="" for='cep'>CEP</label>
                    <input class="form-control" name='cep' type='number'  title='Informe o cep' value='{{$cliente->cep}}' >
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            <hr />
            <div class="form-row">
                <div class="col-md-5 mb-3">
                    <label class="" for='contatonome'>Nome para Contato</label>
                    <input class="form-control" name='contatonome' type='text'  title='Informe nome para Contato' value='{{$cliente->contatonome}}' >
                    <div class="valid-feedback">Certo!</div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <label class="" for='contatotelefone'>Telefone para Contato</label>
                    <input class="form-control" name='contatotelefone' type='number'  title='Informe o Telefone para Contato' value='{{$cliente->contatotelefone}}' >
                    <div class="valid-feedback">Certo!</div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="" for='contatoemail'>Email para Contato</label>
                    <input class="form-control" name='contatoemail' type='text'  title='Informe o Email para Contato' value='{{$cliente->contatoemail}}' >
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label class="" for='observacoes'>Observações</label>
                    <textarea rows="5" cols="100" class="form-control" name='observacoes' title='Informe as Observações'>{{$cliente->observacoes}}</textarea>
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