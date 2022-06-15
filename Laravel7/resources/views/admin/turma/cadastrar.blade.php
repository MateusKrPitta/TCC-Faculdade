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

<div class=" col-lg-12 box box-solid box-footer">{{-- MELHOR Combinação para ajuste na tela --}}
    <!--Formulario-->
    <form class="needs-validation" name='FormularioCadastrarTurma' id='FormularioCadastrarTurma' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações do Turma' name='blocoform01' id='blocoform01'><legend>Informações do Turma</legend>

                <input type="hidden" name="acao" id="acao" value="Turmanovogravar" />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
                <input type="hidden" name="status" id="status" value="1" />
                <input type="hidden" name="usuario_id" id="usuario_id" value="{{$usuario_id}}" />

                <div class="form-row">

                    <div class="col-md-4 mb-3">
                        <label class="" for='nome'>Nome</label>
                        <x-adminlte-input class="form-control" name='nome' type='text' size='50' title='Coloque o nome do Turma' value="{{ $errors->all() ? old('nome') : '' }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>

                    <div class="col-md-3 mb-2">
                        <label class="" for='ano'>Ano</label>
                        <x-adminlte-select2 name="ano" class="form-control col-sm-6">	
                            <option value="2019" {{ $errors->all() & (old('ano') == "2019") ? ' selected' : '' }}>2019</option>
                            <option value="2020" {{ $errors->all() & (old('ano') == "2020") ? ' selected' : '' }}>2020</option>
                            <option value="2021" {{ $errors->all() & (old('ano') == "2021") ? ' selected' : '' }}>2021</option>
                            <option value="2022" {{ $errors->all() & (old('ano') == "2022") ? ' selected' : '' }}>2022</option>
                            <option value="2023" {{ $errors->all() & (old('ano') == "2023") ? ' selected' : '' }}>2023</option>
                            <option value="2024" {{ $errors->all() & (old('ano') == "2024") ? ' selected' : '' }}>2024</option>
                            <option value="2025" {{ $errors->all() & (old('ano') == "2025") ? ' selected' : '' }}>2025</option>
                        </x-adminlte-select2>
                    </div>

                    <div class="col-md-5 mb-2">
                        <label class="" for='periodo'>Período</label>
                        <x-adminlte-select2 name="periodo" class="form-control col-sm-4">
                            <option value="M" {{ $errors->all() & (old('periodo') == "M") ? ' selected' : '' }}>Matutino</option>
                            <option value="V" {{ $errors->all() & (old('periodo') == "V") ? ' selected' : '' }}>Vespertino</option>
                            <option value="E" {{ $errors->all() & (old('periodo') == "E") ? ' selected' : '' }}>Extendido</option>
                            <option value="I" {{ $errors->all() & (old('periodo') == "I") ? ' selected' : '' }}>Integral</option>
                        </x-adminlte-select2>
                    </div>
                </div>

                <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label class="" for='observacoes'>Observações</label>
                    <x-adminlte-textarea rows="5" class="form-control" name='observacoes' title='Informe as Observações'>{{ $errors->all() ? old('observacoes') : '' }}</x-adminlte-textarea>                                   
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            </fieldset>


            <br />
            <div class="form-row">
                <div class="control-label col-sm-4" ></div>
                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>


        </div>
    </form>
</div>


@stop