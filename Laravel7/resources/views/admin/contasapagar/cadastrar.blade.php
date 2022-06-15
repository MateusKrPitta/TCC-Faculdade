@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('fornecedor_id'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('descricao') }} - Valor: R$ {{ number_format(old('valor'),2,',','.') }} - Vencimento: {{ date('d/m/Y', strtotime(old('vencimento')) ) }}</div>
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
    <form class="needs-validation" name='formulariocontasapagar' id='formulariocontasapagar' action="/contasapagar/gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações da Conta a Pagar' name='blocoform01' id='blocoform01'><legend>Informações da Conta a Pagar</legend>

                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
                <input type="hidden" name="usuario_id" id="usuario_id" value="{{$usuario_id}}" />
                <input type="hidden" name="empresa_id" value="0" />
                <input type="hidden" name="usuario_id" value="0" />

                <div class="form-row">
                    <div  class="col-md-6 mb-6">
                        <label class="" for='fornecedor_id'>Fornecedor</label>
                        <x-adminlte-select2 class="form-control" name="fornecedor_id" id='fornecedor_id' title='Escolha o Fornecedor'> 
                            @forelse ($fornecedores as $fornecedor): }}
                                <option value="{{$fornecedor->id }}">{{$fornecedor->nome }} </option> 
                            @empty  
                            <option value="">Cadastre um Fornecedor</option>
                            @endforelse  
                        </x-adminlte-select2>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-6 mb-6">
                        <label class="" for='descricao'>Descricao</label>
                        <x-adminlte-input class="form-control" name='descricao' type='text' size='50' title='Informe o número do título ou NF' value="{{ $errors->all() ? old('descricao') : '' }}"/>
                    </div>
                </div>

                <div class="form-row">
                    <div  class="col-md-2 mb-2">
                        <label class=""  for='valor'>Valor</label>
                        <x-adminlte-input class="form-control" name='valor' type='text' size='10' title='Coloque o valor da conta' value="{{ $errors->all() ? old('valor') : '' }}"/>
                    </div>
                    <div  class="col-md-3 mb-3">
                        <label class="" for='formadepagamento_id'>Forma de Pagamento</label>
                        <x-adminlte-select2 class="form-control" name="formadepagamento_id" id='formadepagamento_id' title='Escolha a forma de pagamento'> 
                            @forelse ($formadepagamentos as $formadepagamento)
                                <option value="{{$formadepagamento->id }}">{{$formadepagamento->nome }} </option> 
                            @empty
                                <option value="0">Nenhuma forma de pagamento cadastrada</option> 
                            @endforelse
                        </x-adminlte-select2>
                    </div>
                </div>

                <div class="form-row">
                    <div  class="col-md-2 mb-2">
                        <label class="" for='vencimento'>Data de Vencimento</label>
                        <x-adminlte-input class="form-control" name='vencimento' type='date' size='10' title='Coloque a data de vencimento' value="{{ $errors->all() ? old('vencimento') : '' }}"/>
                    </div>

                    <div  class="col-md-2 mb-2">
                        <label class="" for='pagamento'>Data de Pagamento</label>
                        <x-adminlte-input class="form-control" name='pagamento' type='date' size='10' title='Coloque a data do pagamento' value="{{ $errors->all() ? old('pagamento') : '' }}"/>
                    </div>

                    <div  class="col-md-2 mb-2">
                        <label class="" for='status'>Status</label>
                        <x-adminlte-select2 class="form-control" name="status" title='Escolha o status do Pagamento' >
                            <option value=1 selected>Pendente</option>
                            <option value=0>Cancelada</option> 
                            <option value=2>Pago</option> 
                        </x-adminlte-select2>
                    </div>
                </div>

                <div class="form-row">
                    <div  class="col-md-10 mb-10">
                        <label class="" for='observacao'>Observação</label>
                        <x-adminlte-textarea class="form-control" name='observacao' type='text' size='50' title='Coloque uma observação se necessário' value="{{ $errors->all() ? old('observacao') : '' }}"></x-adminlte-textarea>
                    </div>
                </div>

                <div class="control-label col-md-6 mb-3" ></div>
                <div class="control-label col-md-6 mb-3" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
                <div class="control-label col-md-2 mb-2" ></div>
            </fieldset>
        </div>
    </form>
</div>

@stop