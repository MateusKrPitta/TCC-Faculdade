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
    <form class="needs-validation" name='FormularioCadastrarConveniado' id='FormularioCadastrarConveniado' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset 
            @if(isset($titular_id))
            class='text-red' 
            @endif
            title='Informações do Conveniado' name='blocoform01' id='blocoform01'><legend>Informações do Conveniado
                @if(isset($titular_id))
                Dependente
                @endif
            </legend>

            <input type="hidden" name="acao" id="acao" value="Conveniadonovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />
            <input type="hidden" name="titular_id" value="{{ $titular_id }}" />


            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label class="" for='imagem'>Fotografia</label>
                    <img id="imagem"
                         name="imagem"
                         src="{{Storage::url('imagem.png')}}"
                         width="100%"/>
                    <br /><br />
                    <input class="form-control col-sm-12" type="file" name="imagem" id="arquivo">

                </div>
                <div class="col-md-10 mb-3">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="" for='nome'>Nome</label>
                            <x-adminlte-input class="form-control" name='nome' type='text' title='Coloque o nome do Conveniado ' value="{{ $errors->all() ? old('nome') : '' }}" />
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="" for='cpfcnpj'>CPF</label>
                            <x-adminlte-input class="form-control" name='cpfcnpj' type='text' title='Informe o número do CPF ou do CNPJ' value="{{ $errors->all() ? old('cpfcnpj') : '' }}"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="" for='rgie'>RG</label>
                            <x-adminlte-input class="form-control" name='rgie' type='text' title='Informe o número do RG ou Inscrição Estadual' value="{{ $errors->all() ? old('rgie') : '' }}" />
                            <div class="valid-feedback">Certo!</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label class="" for='nascimento'>Data de Nascimento</label>
                            <x-adminlte-input class="form-control" name='nascimento' type='date' title='Informe a data do nascimento do Conveniado' value="{{ $errors->all() ? old('nascimento') : '' }}" />
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-2 mb-2">
                            <label class="control-label" for='sexo'>Sexo</label>
                            <x-adminlte-select2 class="form-control" name="sexo" title='Escolha o sexo do conveniado' >
                                <option value='M' {{ $errors->all() & (old('sexo') == "M") ? ' selected' : '' }} >Masculino</option>
                                <option value='F' {{ $errors->all() & (old('sexo') == "F") ? ' selected' : '' }} >Feminino</option> 
                                <option value='O' {{ $errors->all() & (old('sexo') == "O") ? ' selected' : '' }} >Outro</option> 
                                </x-adminlte-select2>
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="control-label" for='estadocivil_id'>Estado Civil</label>
                            <x-adminlte-select2 class="form-control" name="estadocivil_id" id='estadocivil_id' title='Escolha a Opção'> 
                                @forelse ($estadocivils as $estadocivil)
                                <option value="{{$estadocivil->id }}" {{ $errors->all() & (old('estadocivil_id') == $estadocivil->id) ? ' selected' : '' }} >{{$estadocivil->nome }} </option> 
                                @empty
                                <option value="0">Nenhuma opção cadastrada</option>
                                @endforelse
                            </x-adminlte-select2>
                            <div class="valid-feedback">Certo!</div>
                        </div>
                        @if(isset($titular_id))
                        <div class="col-md-4 mb-3">
                            <label class="control-label" for='parentesco_id'>Grau de Parentesco</label>
                            <x-adminlte-select2 class="form-control" name="parentesco_id" id='parentesco_id' title='Escolha o Parentesco'> 
                                @forelse ($parentescos as $parentesco)
                                <option value="{{$parentesco->id }}" {{ $errors->all() & (old('parentesco_id') == $parentesco->id) ? ' selected' : '' }} >{{$parentesco->nome }} </option> 
                                @empty
                                <option value="0">Nenhuma parentesco cadastrado</option>
                                @endforelse
                            </x-adminlte-select2>
                            <div class="valid-feedback">Certo!</div>
                        </div>
                        @endif 
                        <div class="col-md-3 mb-3">
                            <label class="" for='tel1'>Telefone 1</label>
                            <x-adminlte-input class="form-control" name='tel1' type='text' title='Informe o número do Telefone' value="{{ $errors->all() ? old('tel1') : '' }}" />
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="" for='tel2'>Telefone 2</label>
                            <x-adminlte-input class="form-control" name='tel2' type='text' title='Informe o número do Telefone' value="{{ $errors->all() ? old('tel2') : '' }}" />
                            <div class="valid-feedback">Certo!</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="" for='logradouro'>Endereço</label>
                            <x-adminlte-input class="form-control" name='logradouro' type='text' title='Informe o nome do Logradouro' value="{{ $errors->all() ? old('logradouro') : '' }}" placeholder="Rua" />
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="" for='numero'>Número</label>
                            <x-adminlte-input class="form-control" name='numero' type='text' title='Informe o número do Endereço' value="{{ $errors->all() ? old('numero') : '' }}" />
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="" for='bairro'>Bairro</label>
                            <x-adminlte-input class="form-control" name='bairro' type='text' title='Informe o nome do Bairro' value="{{ $errors->all() ? old('bairro') : '' }}"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="col-md-4 mb-3">
                            <label class="" for='complemento'>Complemento</label>
                            <x-adminlte-input class="form-control" name='complemento' type='text' title='Informe o complemento do endereço, Prédio, Apartamento ...' value="{{ $errors->all() ? old('complemento') : '' }}" />
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="" for='cidade'>Cidade</label>
                            <x-adminlte-input class="form-control" name='cidade' type='text' title='Informe o nome da Cidade' value="{{ $errors->all() ? old('cidade') : 'Nova Andradina' }}" />
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="" for='estado'>Estado</label>
                            <x-adminlte-input class="form-control" name='estado' type='text' title='Informe o nome do Estado' value="{{ $errors->all() ? old('estado') : 'MS' }}" />
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="" for='cep'>CEP</label>
                            <x-adminlte-input class="form-control" name='cep' type='text' title='Informe o CEP' value="{{ $errors->all() ? old('cep') : '' }}" />
                            <div class="valid-feedback">Certo!</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="" for='email'>E-Mail</label>
                            <x-adminlte-input class="form-control" name='email' type='email' title='Informe o endereço de e-mail' value="{{ $errors->all() ? old('email') : '' }}" />
                            <div class="valid-feedback">Certo!</div>
                        </div>
                    </div>

                    <input type="hidden" name="status" id="status" value="1" />
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
<br /><br /><br /><br />
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