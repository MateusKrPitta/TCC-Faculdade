@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('valor'))
@if(!$errors->all())
<div class="alert alert-success">Adicionado</div>
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
    <form class="needs-validation" name='FormularioCadastrarContratoescola' id='FormularioCadastrarContratoescola' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >
        <fieldset title='Informações do Contrato' name='blocoform01' id='blocoform01'><legend>Informações do Contrato</legend>
            <input type="hidden" name="acao" id="acao" value="Contratoescolanovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <div class="form-row">
                <div class="col-md-4 mb-2">
                    <label class="" for='cliente_id'>Cliente</label>
                    <x-adminlte-select2 class="form-control" name="cliente_id" title='Escolha o Cliente'>
                        @forelse($clientes as $cliente)
                        <option value="{{$cliente->id}}" {{ ( $errors->all() && old('cliente_id')==$cliente->id ) ? ' selected ' : '' }} > {{$cliente->nome}} </option>
                        @empty
                        <option value="">Cadastre um Cliente</option>
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-4 mb-2">
                    <label class="" for='aluno_id'>Aluno</label>
                    <x-adminlte-select2 class="form-control" name="aluno_id" title='Escolha o Aluno'>
                        @forelse($alunos as $aluno)
                        <option value="{{$aluno->id}}" {{ ( $errors->all() && old('aluno_id')==$aluno->id ) ? ' selected ' : '' }} > {{$aluno->nome}} </option>
                        @empty
                        <option value="">Cadastre um Aluno</option>
                        @endforelse
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='datadocontrato'>Data do contrato</label>
                    <x-adminlte-input class="form-control" name='datadocontrato' type='date'  title='Data do contrato' value="{{ $errors->all() ? old('datacontrato') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-2 mb-2">
                    <label class="" for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='text'  title='Valor do Contrato' value="{{ $errors->all() ? old('valor') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='formadepagamento_id'>Forma de Pagamento</label>
                    <x-adminlte-select2 class="form-control" name="formadepagamento_id" title='Escolha a forma de pagamento'>
                        @foreach($formadepagamentos as $formadepagamento)
                        <option value="{{$formadepagamento->id}}" {{ ( $errors->all() && old('formadepagamento_id')==$formadepagamento->id ) ? ' selected ' : '' }} > {{$formadepagamento->nome }} </option>
                        @endforeach
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='modalidade'>Modalidade do Contrato</label>
                    <x-adminlte-select2 name="modalidade" class="form-control">
                        <option value="M" {{ $errors->all() & (old('modalidade') == "M") ? ' selected' : '' }} >Matutino</option>
                        <option value="V" {{ $errors->all() & (old('modalidade') == "V") ? ' selected' : '' }} >Vespertino</option>
                        <option value="E" {{ ($errors->all() & (old('modalidade') == "E") || (!$errors->all()) ) ? ' selected' : '' }} >Estendido</option>
                        <option value="I" {{ $errors->all() & (old('modalidade') == "I") ? ' selected' : '' }} >Integral</option>
                        <option value="B" {{ $errors->all() & (old('modalidade') == "B") ? ' selected' : '' }} >Bercário</option>
                    </x-adminlte-select2>
                </div>   
                <div class="col-md-2 mb-3">
                    <label class="" for='anoletivo'>Ano Letivo</label>
                    <x-adminlte-select2 name="anoletivo" class="form-control">
                        <option value="{{ date('Y')-2 }}" {{ $errors->all() & (old('anoletivo') == date('Y')-2 ) ? ' selected' : '' }} >{{ date('Y')-2 }}</option>
                        <option value="{{ date('Y')-1 }}" {{ $errors->all() & (old('anoletivo') == date('Y')-1 ) ? ' selected' : '' }} >{{ date('Y')-1 }}</option>
                        <option value="{{ date('Y') }}" {{ $errors->all() & (old('anoletivo') == date('Y') ) ? ' selected' : '' }} >{{ date('Y') }}</option>
                        <option value="{{ date('Y')+1 }}" {{ $errors->all() & (old('anoletivo') == date('Y')+1 ) ? ' selected' : '' }} >{{ date('Y')+1 }}</option>
                        <option value="{{ date('Y')+2 }}" {{ $errors->all() & (old('anoletivo') == date('Y')+2 ) ? ' selected' : '' }} >{{ date('Y')+2 }}</option>
                    </x-adminlte-select2>
                </div> 
                <div class="col-md-5 mb-3">
                    <label class="" for='autorizaredessociais'>Autoriza o Uso da Imagem do Aluno em Redes Sociais?</label>
                    <x-adminlte-select2 name="autorizaredessociais" class="form-control col-md-7">
                        <option value="S" {{ $errors->all() & (old('autorizaredessociais') == "S") ? ' selected' : '' }} >Sim</option>
                        <option value="N" {{ $errors->all() & (old('autorizaredessociais') == "N") ? ' selected' : '' }} >Não</option>
                    </x-adminlte-select2>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <label class="" for='titulocontrato1'>Título no contrato primeira linha</label>                   
                    <x-adminlte-input class="form-control " name='titulocontrato1' type='text' title='Título no contrato primeira linha' value="{{ $errors->all() ? old('titulocontrato1') : $config->titulocontrato1  }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <label class="" for='titulocontrato2'>Título no contrato segunda linha</label>
                    <x-adminlte-input class="form-control " name='titulocontrato2' type='text' title='Título no contrato segunda linha' value="{{ $errors->all() ? old('titulocontrato2') : $config->titulocontrato2  }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <label class="" for='endereco1'>Endereço primeira linha</label>                   
                    <x-adminlte-input class="form-control " name='endereco1' type='text' title='Endereço primeira linha' value="{{ $errors->all() ? old('endereco1') : $config->endereco1  }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <label class="" for='endereco2'>Endereço segunda linha</label>                   
                    <x-adminlte-input class="form-control " name='endereco2' type='text' title='Endereço segunda linha' value="{{ $errors->all() ? old('endereco2') : $config->endereco2  }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <label class="" for='razaosocial'>Razão Social no Contrato</label>                   
                    <x-adminlte-input class="form-control " name='razaosocial' type='text' title='Razão Social no Contrato' value="{{ $errors->all() ? old('razaosocial') : $config->razaosocial  }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <label class="" for='enderecorazaosocial'>Endereço da Razão Social</label>                   
                    <x-adminlte-input class="form-control " name='enderecorazaosocial' type='text' title='Endereço da Razão Social' value="{{ $errors->all() ? old('enderecorazaosocial') : $config->enderecorazaosocial  }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <label class="" for='cnpj'>CNPJ no contrato</label>                   
                    <x-adminlte-input class="form-control " name='cnpj' type='text' title='CNPJ no contrato' value="{{ $errors->all() ? old('cnpj') : $config->cnpj  }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <label class="" for='inscricaomunicipal'>Inscrição Municipal no contrato</label>                   
                    <x-adminlte-input class="form-control " name='inscricaomunicipal' type='text' title='Inscrição Municipal no contrato' value="{{ $errors->all() ? old('inscricaomunicipal') : $config->inscricaomunicipal  }}"/>
                </div>
            </div>
            <div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='valorintegral'>Valor Anual Integral</label>                   
                        <x-adminlte-input class="form-control " name='valorintegral' type='text' title='Valor Anual Integral' value="{{ $errors->all() ? old('valorintegral') : $config->valorintegral  }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='valorparcial'>Valor Anual Parcial</label>                   
                        <x-adminlte-input class="form-control " name='valorparcial' type='text' title='Valor Anual Parcial' value="{{ $errors->all() ? old('valorparcial') : $config->valorparcial  }}"/>
                    </div>
                </div><div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='valorhoraextra'>Valor Hora Extra</label>                   
                        <x-adminlte-input class="form-control " name='valorhoraextra' type='text' title='Valor Hora Extra' value="{{ $errors->all() ? old('valorhoraextra') : $config->valorhoraextra  }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='valorrefeicaoextra'>Valor Refeição Extra</label>                   
                        <x-adminlte-input class="form-control " name='valorrefeicaoextra' type='text' title='Valor Refeição Extra' value="{{ $errors->all() ? old('valorrefeicaoextra') : $config->valorrefeicaoextra  }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-2">
                        <label class="" for='valor19horas'>Valor após as 19:00</label>                   
                        <x-adminlte-input class="form-control " name='valor19horas' type='text' title='Valor após as 19:00' value="{{ $errors->all() ? old('valor19horas') : $config->valor19horas  }}"/>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <label class="" for='horariointegral'>Horário de Funcionamento Integral</label>                   
                    <x-adminlte-input class="form-control " name='horariointegral' type='text' title='Horário de Funcionamento Integral' value="{{ $errors->all() ? old('horariointegral') : $config->horariointegral  }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <label class="" for='horarioparcial'>Horário de Funcionamento Parcial</label>                   
                    <x-adminlte-input class="form-control " name='horarioparcial' type='text' title='Horário de Funcionamento Parcial' value="{{ $errors->all() ? old('horarioparcial') : $config->horarioparcial  }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <label class="" for='anexotexto'>Texto no Anexo</label>                   
                    <x-adminlte-textarea  class="form-control " name='anexotexto' type='text' title='Texto no Anexo' rows=5 >{{ $errors->all() ? old('anexotexto') : $config->anexotexto  }}</x-adminlte-textarea>
                </div>
            </div>
            
            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <label class="" for='cidadeforo'>Comarca da cidade eleita como Foro</label>                   
                    <x-adminlte-input class="form-control " name='cidadeforo' type='text' title='Comarca da cidade eleita como Foro' value="{{ $config->cidadeforo }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-2">                  
                    <x-adminlte-input class="form-control " name='cidadecontrato' type='text' label='Cidade de assinatura do contrato' title='Cidade de assinatura do contrato' value="{{ $config->cidadecontrato }}"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-2">
                    <x-adminlte-input class="form-control" name='observacao' type='text' label='Observação'  title='Observações sobre o contrato' value="{{ $errors->all() ? old('observacao') : '' }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <br />
            <div class="form-row">

                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>
        </fieldset>
</div>
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