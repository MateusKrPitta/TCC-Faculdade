@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('cliente_id'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('descricao') }} - Valor: R$ {{ old('valor') }} - Vencimento: {{ old('vencimento') }}</div>
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
    <form class="needs-validation" name='formulariocontasapagar' id='formulariocontasapagar' action="/contasareceber/atualizar" enctype="application/x-www-form-urlencoded" method="post" >

        <div>
            <fieldset title='Informações da Conta' name='blocoform01' id='blocoform01'><legend>Informações da Conta a Receber</legend>
                <input type="hidden" name="usuario_id" id="usuario_id" value="{{$usuario_id}}" />
                <input type="hidden" name="id" id="id" value="{{$id}}" />
                <input type="hidden" name="_token" value=" {{ csrf_token() }} " />

                <div class="form-row">
                    <div  class="col-md-6 mb-6">
                        <label class="" for='cliente_id'>Cliente</label>
                        <x-adminlte-select2 class="form-control" name="cliente_id" id="cliente_id" title="Escolha o Cliente"> 
                            @forelse ($clientes as $cliente)

                            <option value='{{ $cliente->id}}' {{ $contasareceber[0]->cliente_id == $cliente->id ? ' selected' : '' }} >{{ $cliente->nome}}</option>                                        
                            @empty
                            @endforelse
                        </x-adminlte-select2>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-md-6 mb-6">
                        <label class="" for='descricao'>Descricao</label>
                        <x-adminlte-input class="form-control" name='descricao' type='text' size='50' title='Informe o número do título ou NF' value="{{ $contasareceber[0]->descricao }}" />
                    </div>
                </div>

                <div class="form-row">
                    <div  class="col-md-2 mb-2">
                        <label class=""  for='valor'>Valor</label>
                        <x-adminlte-input class="form-control" name='valor' type='text' size='10' title='Coloque o valor da conta' value="{{ number_format($contasareceber[0]->valor,2,',','.') }}" />
                    </div>
                    <div  class="col-md-3 mb-3">
                        <label class="" for='formadepagamento_id'>Forma de Pagamento</label>
                        <x-adminlte-select2 class="form-control" name="formadepagamento_id" id='formadepagamento_id' title='Escolha a forma de pagamento'> 
                            @forelse ($formadepagamentos as $formadepagamento)
                            <option value='{{ $formadepagamento->id }}' {{ $contasareceber[0]->formadepagamento_id == $formadepagamento->id ? ' selected' : '' }} >{{ $formadepagamento->nome}}</option>
                            @empty
                            <option value="0">Nenhuma forma de pagamento cadastrada</option> 
                            @endforelse
                        </x-adminlte-select2>
                    </div>
                </div>

                <div class="form-row">
                    <div  class="col-md-2 mb-2">
                        <label class="" for='vencimento'>Data de Vencimento</label>
                        <x-adminlte-input class="form-control" name='vencimento' type='date' size='10' title='Coloque a data de vencimento' value="{{ $contasareceber[0]->vencimento }}" />
                    </div>

                    <div  class="col-md-2 mb-2">
                        <label class="" for='pagamento'>Data de Pagamento</label>
                        <x-adminlte-input class="form-control" name='pagamento' type='date' size='10' title='Coloque a data do pagamento' value="{{ $contasareceber[0]->pagamento }}" />
                    </div>

                    <div  class="col-md-2 mb-2">
                        <label class="" for='status'>Status</label>
                        <x-adminlte-select2 class="form-control" name="status" title='Escolha o status do Pagamento' >
                            <option value='1' {{ $contasareceber[0]->status == 1 ? ' selected' : '' }} >Pendente</option> 
                            <option value='0' {{ $contasareceber[0]->status == 0 ? ' selected' : '' }} >Cancelado</option>
                            <option value='2' {{ $contasareceber[0]->status == 2 ? ' selected' : '' }} >Pago</option>
                        </x-adminlte-select2>
                    </div>
                </div>

                <div class="form-row">
                    <div  class="col-sm-10">
                        <label class="" for='observacao'>Observação</label>
                        <x-adminlte-textarea class="form-control" name='observacao' type='text' size='50' title='Coloque uma observação se necessário' value="{{$contasareceber[0]->observacao}}"></x-adminlte-textarea>
                    </div>
                </div>



                <div class="control-label col-md-2 mb-2" ></div>
                <div class="control-label col-md-6 mb-6" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
                <div class="control-label col-md-2 mb-2" ></div>
            </fieldset>
        </div>
    </form>
</div>

@stop