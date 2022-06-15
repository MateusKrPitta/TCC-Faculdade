@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if($erro)
<div class="alert alert-danger"> {{ $erro }}</div>
@endif

@if(old('numeronocartao'))
@if(!$errors->all())
<div class="alert alert-danger"> Número do Cartão Inválido.</div>
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
    <form class="needs-validation" name='FormularioEditarConvenioAtendimento' id='FormularioEditarConvenioAtendimento' action="/convenioatendimento/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Registro do Atendimento' name='blocoform01' id='blocoform01'><legend>Registro do Atendimento</legend>

            <input type="hidden" name="acao" id="acao" value="EditarConvenioAtendimento" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <input type="hidden" name="id" id="id" value='{{ $convenioatendimento->id }}' />

            <div class="form-row">
                <div class="col-md-3 mb-4">
                    <label class="" for='numeronocartao'>Número do Cartão</label>
                    <x-adminlte-input class="form-control" name='numeronocartao' type='text' size='16' title='Informe o número no cartão' value="{{ $errors->all() ? old('numeronocartao') : $convenioatendimento->cartao_numeronocartao }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-4">
                    <label class="" for='data'>Data do Atendimento</label>
                    <x-adminlte-input class="form-control" name='data' type='date' title='Informe data do atendimento' value="{{ $errors->all() ? old('data') : $convenioatendimento->data }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-6 mb-4">
                    <label class="" for='credenciado_id'>Credenciado</label>
                    <x-adminlte-select2 name="credenciado_id" class="form-control">
                        @forelse($credenciados as $credenciado)
                        <option value="{{$credenciado->id}}" {{ $convenioatendimento->credenciado_id == $credenciado->id ? ' selected' : '' }} >{{$credenciado->nome}}</option>
                        @empty
                        <option value="">Nenhum Credenciado Cadastrado</option>
                        @endforelse
                        </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            <div class="form-row">
                <div  class="col-md-3 mb-2">
                    <label class="control-label" for='tipodeatendimento'>Tipo de Atendimento</label>
                    <x-adminlte-select2 class="form-control" name="tipodeatendimento" title='Escolha o tipo de Atendimento' >
                        @forelse($conveniotipodeatendimentos as $conveniotipodeatendimento)
                        <option value="{{$conveniotipodeatendimento->id}}" {{ $convenioatendimento->tipodeatendimento_id == $conveniotipodeatendimento->id ? ' selected' : '' }} >{{$conveniotipodeatendimento->nome}}</option>
                        @empty
                        <option value="">Nenhum Tipo de Atendimento Cadastrado</option>
                        @endforelse
                        </x-adminlte-select2>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='valor'>Valor</label>
                    <x-adminlte-input class="form-control" name='valor' type='text' size='16' title='Informe o valor recebido' value='{{ $errors->all() ? old('valor') : number_format($convenioatendimento->valor,2,',','.') }}' >
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-7 mb-6">
                    <label class="" for='nomedoresponsavel'>Nome do responsável pelo atendimento</label>
                    <x-adminlte-input class="form-control" name='nomedoresponsavel' type='text' size='50' title='Informe o nome do médico ou técnico que realizou o atendimento' value="{{ $errors->all() ? old('nomedoresponsavel') : $convenioatendimento->nomedoresponsavel }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-10">
                    <label class="" for='observacao'>Observação</label>
                    <x-adminlte-textarea class="form-control col-md-12" name='observacoes' type='text' size='50' rows="5" cols="33"  title='Coloque detalhes adicionais sobre o atendimento'>{{ $errors->all() ? old('observacao') : '' }}</x-adminlte-textarea>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <br /><br /><br />

            <div class="form-row">
                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar o evento.'>Gravar</button>
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