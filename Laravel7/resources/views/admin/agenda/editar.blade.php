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
    <form class="needs-validation" name='FormularioEditarAgenda' id='FormularioEditarAgenda' action="/agenda/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações do Agenda' name='blocoform01' id='blocoform01'><legend>Informações do Agenda</legend>

                <input type="hidden" name="acao" id="acao" value="Agendaeditar" />
                <input type="hidden" name="id" id="id" value='{{ $agenda[0]->id }}' />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
                <input type="hidden" name="empresa_id" value="2" />
                <input type="hidden" name="usuario_id" value="2" />

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label class="" for='nome'>Nome</label>
                        <x-adminlte-input class="form-control" name='nome' type='text' size='90' title='Coloque o nome do Agenda' value="{{ $agenda[0]->nome }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-4">
                        <label class="" for='evento'>Evento</label>
                        <x-adminlte-input class="form-control" name='evento' type='text' title='Informe o nome do Evento' value="{{ $agenda[0]->evento }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>

                    <div class="col-md-2 mb-2">
                        <label class="" for='data'>Data</label>
                        <x-adminlte-input class="form-control" name='data' type='date'  title='Informe a data do Evento' value="{{ $agenda[0]->data }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>


                    <div class="col-md-2 mb-2">
                        <label class="" for='hora'>Hora</label>
                        <x-adminlte-input class="form-control" name='hora' type='time' title='Informe a hora do Evento' value="{{ $agenda[0]->hora }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>
                <div class="form-row">

                    <div class="col-md-6 mb-6">
                        <label class="" for='observacoes'>Observações</label>
                        <x-adminlte-textarea class="form-control" name='observacao' type='text' title='Informe detalhes sobre a agenda'>{{ $agenda[0]->observacao }}</x-adminlte-textarea>
                        <div class="valid-feedback">Certo!</div>
                    </div>

                    <div class="col-md-1 mb-1">
                        <label class="control-label col-sm-1" for='status'>Status</label>
                        <x-adminlte-select2 class="form-control" name="status" title='Escolha o status' >
                            <option value="1" {{ $agenda[0]->status == "1" ? 'selected' : '' }}>Ativo</option> 
                            <option value="0" {{ $agenda[0]->status == "0" ? 'selected' : '' }}>Inativo</option> 
                        </x-adminlte-select2>
                    </div><!-- comment -->

                </div>

                <div class="form-row">

                    <div class="control-label col-sm-4" >
                        <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                    </div>
                </div>

            </fieldset>
        </div>
    </form>

</div>

@stop