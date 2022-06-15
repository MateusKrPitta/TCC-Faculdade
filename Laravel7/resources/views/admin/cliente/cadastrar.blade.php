@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }} - {{ old('cpfcnpj') }}</div>
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
    <form class="needs-validation" name='FormularioCadastrarCliente' id='FormularioCadastrarCliente' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Cliente' name='blocoform01' id='blocoform01'><legend>Informações do Cliente</legend>

            <input type="hidden" name="acao" id="acao" value="Clientenovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="status" id="status" value="1" />

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label class="" for='nome'>Nome ou Nome Fantasia</label>
                    <x-adminlte-input class="form-control" name='nome' type='text' title='Coloque o nome do Cliente ou Nome Fantasia da Empresa' value="{{ $errors->all() ? old('nome') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='cpfcnpj'>CPF ou CNPJ</label>
                    <x-adminlte-input class="form-control" name='cpfcnpj' type='text' title='Informe o número do CPF ou do CNPJ' value="{{ $errors->all() ? old('cpfcnpj') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='rgie'>RG ou Inscrição Estadual</label>
                    <x-adminlte-input class="form-control" name='rgie' type='text' title='Informe o número do RG ou Inscrição Estadual' value="{{ $errors->all() ? old('rgie') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

            </div>
            <div class="form-row">                  
                <div class="col-md-6 mb-3">
                    <label class="" for='razaosocial'>Razão Social (Apenas para empresas)</label>
                    <x-adminlte-input class="form-control" name='razaosocial' type='text' title='Informe a Razão Social' value="{{ $errors->all() ? old('razaosocial') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="" for='email'>Email</label>
                    <x-adminlte-input class="form-control" name='email' type='text' title='Informe o Email' value="{{ $errors->all() ? old('email') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>            
            </div>
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='nascimento'>Data de Nascimento</label>
                    <x-adminlte-input class="form-control" name='nascimento' type='date' title='Informe a data do nascimento do Cliente' value="{{ $errors->all() ? old('nascimento') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="control-label" for='sexo'>Sexo</label>
                    <x-adminlte-select2  class="form-control" name="sexo" title='Escolha o sexo do cliente' >
                        <option value='M' {{ $errors->all() & (old('sexo') == "M") ? ' selected' : '' }} >Masculino</option>
                        <option value='F' {{ $errors->all() & (old('sexo') == "F") ? ' selected' : '' }} >Feminino</option> 
                        <option value='O' {{ $errors->all() & (old('sexo') == "O") ? ' selected' : '' }} >Outro</option> 
                        </x-adminlte-select2> 
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='tel1'>Telefone 1</label>
                    <x-adminlte-input class="form-control" name='tel1' type='text' title='Informe o número do Telefone' value="{{ $errors->all() ? old('tel1') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='tel2'>Telefone 2</label>
                    <x-adminlte-input class="form-control" name='tel2' type='text' title='Informe o número do Telefone' value="{{ $errors->all() ? old('tel2') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label class="" for='logradouro'>Endereço</label>
                    <x-adminlte-input class="form-control" name='logradouro' type='text'  title='Informe o nome do Logradouro' value="{{ $errors->all() ? old('logradouro') : 'Rua' }}" placeholder="Rua"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-1 mb-3">
                    <label class="" for='numero'>Número</label>
                    <x-adminlte-input class="form-control" name='numero' type='text' title='Informe o número do Endereço' value="{{ $errors->all() ? old('numero') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='bairro'>Bairro</label>
                    <x-adminlte-input class="form-control" name='bairro' type='text'  title='Informe o nome do Bairro' value="{{ $errors->all() ? old('bairro') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="" for='complemento'>Complemento</label>
                    <x-adminlte-input class="form-control" name='complemento' type='text'  title='Informe o complemento' value="{{ $errors->all() ? old('complemento') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-5 mb-3">
                    <label class="" for='cidade'>Cidade</label>
                    <x-adminlte-input class="form-control" name='cidade' type='text'  title='Informe o nome da Cidade' value="{{ $errors->all() ? old('cidade') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-1 mb-3">
                    <label class="" for='estado'>Estado</label>
                    <x-adminlte-input class="form-control" name='estado' type='text'  title='Informe a sigla do Estado' value="{{ $errors->all() ? old('estado') : 'MS' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-3">
                    <label class="" for='cep'>CEP</label>
                    <x-adminlte-input class="form-control" name='cep' type='number'  title='Informe o cep' value="{{ $errors->all() ? old('cep') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <hr />
            <div class="form-row">
                <div class="col-md-5 mb-3">
                    <label class="" for='contatonome'>Nome para Contato</label>
                    <x-adminlte-input class="form-control" name='contatonome' type='text'  title='Informe nome para Contato' value="{{ $errors->all() ? old('contatonome') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="" for='contatotelefone'>Telefone para Contato</label>
                    <x-adminlte-input class="form-control" name='contatotelefone' type='number'  title='Informe o Telefone para Contato' value="{{ $errors->all() ? old('contatotelefone') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="" for='contatoemail'>Email para Contato</label>
                    <x-adminlte-input class="form-control" name='contatoemail' type='text'  title='Informe o Email para Contato' value="{{ $errors->all() ? old('contatoemail') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label class="" for='observacoes'>Observações</label>
                    <x-adminlte-textarea rows="5" class="form-control" name='observacoes' title='Informe as Observações'>{{ $errors->all() ? old('observacoes') : '' }}</x-adminlte-textarea>                                   
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            <input type="hidden" name="status" id="status" value="1" />
            <hr />

            <div class="form-row">
                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@stop