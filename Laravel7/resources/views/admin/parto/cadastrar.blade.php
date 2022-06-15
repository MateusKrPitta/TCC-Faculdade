@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('dataparto'))
@if(!$errors->all())
<div class="alert alert-success"> Parto acompanhado por {{ old('acompanhante') }} em {{ date( 'd/m/Y' , strtotime(old('dataparto'))) }} </div>
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
    <form class="needs-validation" name='FormularioCadastrarParto' id='FormularioCadastrarParto' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações da Gestação' name='blocoform01' id='blocoform01'><legend>Informações do Parto</legend>

                <input type="hidden" name="acao" id="acao" value="Partonovogravar" />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />

                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="" for='gestacao_id'>Animal</label>             
                        <x-adminlte-select2 name="gestacao_id" class="form-control">
                            @forelse($listadeanimais as $animal)
                            <option value="{{ $animal->gestacao_id }}">{{ $animal->animal_nome }}</option>
                            @empty
                            <option value="">Cadastre um animal</option>
                            @endforelse
                        </x-adminlte-select2>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="" for='dataparto'>Data do Parto</label>
                        <x-adminlte-input class="form-control" name='dataparto' type='date' size='50' title='Informe a data do Parto' value="{{ $errors->all() ? old('dataparto') : '' }}"/>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="" for='acompanhante'>Nome do Acompanhante</label>
                        <x-adminlte-input class="form-control" name='acompanhante' type='text' size='50' title='Coloque o nome do Acompanhante' value="{{ $errors->all() ? old('acompanhante') : '' }}"/>
                    </div>
                    <div class="row callout callout-success">
                        <div class="mb-3">
                            Dados do Filhote
                        </div>
                        <div class="box-body">
                            <div class="form-row">                           
                                <div class="col-md-3 mb-3">
                                    <label class="" for='status_parto'>Situação</label>
                                    <select name="status_parto" class="form-control">
                                        <option value="V"{{ $errors->all() & (old('status_parto') == "V") ? ' selected' : '' }}>Vivo</option>
                                        <option value="M"{{ $errors->all() & (old('status_parto') == "M") ? ' selected' : '' }}>Morto</option>
                                    </select>
                                </div>                          
                                <div class="col-md-2 mb-3">
                                    <label class="" for='peso'>Peso KG</label>
                                    <x-adminlte-input class="form-control " name='peso' type='text' size='50' title='Informe o peso do animal em quilos' value="{{ $errors->all() ? old('peso') : '' }}"/>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="" for='nome'>Nome</label>
                                    <x-adminlte-input class="form-control" name='nome' type='text' size='50' title='Coloque o nome do Animal' value="{{ $errors->all() ? old('nome') : '' }}"/>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="" for='numero'>Número</label>
                                    <x-adminlte-input class="form-control" name='numero' type='number' size='50' title='Coloque o número do brinco Animal' value="{{ $errors->all() ? old('numero') : '' }}"/>
                                </div>                      
                                    <div class="col-md-2 mb-3">
                                        <label class="" for='sexo'>Sexo</label>
                                        <x-adminlte-select2 name="sexo" class="form-control">
                                            <option value="F"{{ $errors->all() & (old('sexo') == "F") ? ' selected' : '' }}>Fêmea</option>
                                            <option value="M"{{ $errors->all() & (old('sexo') == "M") ? ' selected' : '' }}>Macho</option>
                                        </x-adminlte-select2>
                                    </div>
                                </div>

                            </div>
                            <input type="hidden" name="status" id="status" value="1" />


                        </div> {{-- Fim BOX BODY --}}
                    </div>{{-- Fim BOX --}}

                    <div class="form-row">
                        <div class="control-label col-sm-2" ></div>
                        <div class="control-label col-sm-4" >
                            <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                        </div>
                    </div>

            </fieldset>
        </div>
    </form>
</div>

@stop