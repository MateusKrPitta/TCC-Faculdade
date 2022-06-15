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
    <form class="needs-validation" name='FormularioCadastrarCredenciado' id='FormularioCadastrarCredenciado' action="gravar" enctype="multipart/form-data" method="post" >

        <fieldset title='Informações do Credenciado' name='blocoform01' id='blocoform01'><legend>Informações do Credenciado</legend>

            <input type="hidden" name="acao" id="acao" value="Credenciadonovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="empresa_id" value="0" />
            <input type="hidden" name="usuario_id" value="0" />

            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label class="" for='imagem'>Imagem / Logotipo</label>
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
                            <x-adminlte-input class="form-control" name='nome' type='text' title='Coloque o nome do Credenciado ' value="{{ $errors->all() ? old('nome') : '' }}"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="" for='cpfcnpj'>CPF</label>
                            <x-adminlte-input class="form-control" name='cpfcnpj' type='text' title='Informe o número do CPF ou do CNPJ' value="{{ $errors->all() ? old('cpfcnpj') : '' }}"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="" for='rgie'>RG</label>
                            <x-adminlte-input class="form-control" name='rgie' type='text' title='Informe o número do RG ou Inscrição Estadual' value="{{ $errors->all() ? old('rgie') : '' }}"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label class="" for='nascimento'>Data de Nascimento</label>
                            <x-adminlte-input class="form-control" name='nascimento' type='date' title='Informe a data do nascimento do Credenciado' value="{{ $errors->all() ? old('nascimento') : '' }}"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="control-label" for='sexo'>Sexo</label>
                            <x-adminlte-select2 class="form-control" name="sexo" title='Escolha o sexo do credenciado' >
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
                        <div class="col-md-2 mb-3">
                            <label class="" for='whatsapp'>Whatsapp</label>
                            <x-adminlte-input class="form-control" name='whatsapp' type='text' title='Informe o número do Whatsapp' value="{{ $errors->all() ? old('whatsapp') : '' }}" placeholder="(67) 98765-4321"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="" for='instagram'>Instagram</label>
                            <x-adminlte-input class="form-control" name='instagram' type='text' title='Informe o endereço do Instagram' value="{{ $errors->all() ? old('instagram') : '' }}" placeholder="https://www.instagram.com/seunomeregistrado"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="" for='facebook'>Facebook</label>
                            <x-adminlte-input class="form-control" name='facebook' type='text' title='Informe o endereço do Facebook' value="{{ $errors->all() ? old('facebook') : '' }}" placeholder="https://www.facebook.com/seunomeregistrado"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-4">
                            <label class="" for='email'>E-Mail</label>
                            <x-adminlte-input class="form-control" name='email' type='email' title='Informe o endereço eletrônico' value="{{ $errors->all() ? old('email') : '' }}" placeholder="seunome@seudominio.com.br"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="" for='site'>Site</label>
                            <x-adminlte-input class="form-control" name='site' type='url' title='Informe o endereço do site' value="{{ $errors->all() ? old('site') : '' }}" placeholder="http://www.seusite.com.br"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="col-md-4 mb-3">
                            <label class="" for='logradouro'>Endereço</label>
                            <x-adminlte-input class="form-control" name='logradouro' type='text' title='Informe o nome do Logradouro' value="{{ $errors->all() ? old('logradouro') : '' }}" placeholder="Rua"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-1 mb-3">
                            <label class="" for='numero'>Número</label>
                            <x-adminlte-input class="form-control" name='numero' type='text' title='Informe o número do Endereço' value="{{ $errors->all() ? old('numero') : '' }}"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="" for='bairro'>Bairro</label>
                            <x-adminlte-input class="form-control" name='bairro' type='text' title='Informe o nome do Bairro' value="{{ $errors->all() ? old('bairro') : '' }}"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="" for='cidade'>Cidade</label>
                            <x-adminlte-input class="form-control" name='cidade' type='text' title='Informe o nome da Cidade' value="{{ $errors->all() ? old('cidade') : 'Nova Andradina' }}"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-1 mb-3">
                            <label class="" for='estado'>Estado</label>
                            <x-adminlte-input class="form-control" name='estado' type='text' title='Informe o nome do Estado' value="{{ $errors->all() ? old('estado') : 'MS' }}"/>
                            <div class="valid-feedback">Certo!</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="control-label" for='credenciadocategoria_id'>Categoria do credenciado</label>
                            <x-adminlte-select2 class="form-control" name="credenciadocategoria_id" id='credenciadocategoria_id' title='Escolha a Categoria'> 
                                @forelse ($credenciadocategorias as $credenciadocategoria)
                                <option value="{{$credenciadocategoria->id }}">{{$credenciadocategoria->nome }} </option> 
                                @empty
                                <option value="">Nenhuma categoria cadastrada</option>
                                @endforelse
                            </x-adminlte-select2>
                            <div class="valid-feedback">Certo!</div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="status" id="status" value="1" />


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