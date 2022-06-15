@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('placa'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('marcamodelo') }} - {{ old('placa') }}</div>
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
    <form class="needs-validation" name='FormularioCadastrarVeiculo' id='FormularioCadastrarVeiculo' action="gravar" enctype="application/x-www-form-urlencoded" method="post" >

        <fieldset title='Informações do Veiculo 2' name='blocoform01' id='blocoform01'><legend>Informações do Veiculo</legend>

            <input type="hidden" name="acao" id="acao" value="Veiculonovogravar" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label class="" for='nome'>Nome 2(Apelido para Veículo)</label>
                    <x-adminlte-input class="form-control" name='nome' type='text' title='Coloque o nome do Veiculo' value="{{ $errors->all() ? old('nome') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='acentos'>Acentos(Ônibus)</label>
                    <input class="form-control" name='acentos' type='number' title='Informe a quantidade de poltronas do veículo' value="{{ $errors->all() ? old('acentos') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='desenho'>Desenho do Veículo(Ônibus)</label>
                    <x-adminlte-select2 class="form-control" name="desenho" title='Escolha o layout do veículo'>
                        <option value="" {{ $errors->all() & (old('desenho') == "") ? ' selected' : '' }}>Nenhum</option>
                        <option value="veiculo1" {{ $errors->all() & (old('desenho') == "veiculo1") ? ' selected' : '' }}>Onibus 48 poltronas</option>
                        <option value="veiculo2" {{ $errors->all() & (old('desenho') == "veiculo2") ? ' selected' : '' }}>Onibus 55 poltronas 2 pisos</option>
                        <option value="veiculo3" {{ $errors->all() & (old('desenho') == "veiculo3") ? ' selected' : '' }}>Caminhão</option>
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='imagem'>Imagem do Veículo(Ônibus)</label>
                    <input class="form-control" name='imagem' type='file' title='Informe o número do Telefone' value='' >
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>

            <hr />
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label class="" for='marca_id'>Marca</label>
                    <x-adminlte-select2 class="form-control" name="marca_id" title='Escolha a marca do veiculo'>
                        <option value="">Nenhum</option>
                        @forelse($marcas as $marca)
                        <option value="{{$marca->id}}"{{ $errors->all() & (old('marca_id') == $marca->id) ? ' selected' : '' }} >{{$marca->marca}} </option>
                        @empty
                        <option value="">Nenhuma marca cadastrado</option> 
                        @endforelse
                    </x-adminlte-select2>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='marcamodelo'>Modelo</label>
                    <x-adminlte-input class="form-control" name='marcamodelo' type='text' title='Informe o modelo do veículo' value="{{ $errors->all() ? old('marcamodelo') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='placa'>Placa</label>
                    <x-adminlte-input class="form-control" name='placa' type='text' title='Informe o número da placa do veículo' value="{{ $errors->all() ? old('placa') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>

                <div class="col-md-2 mb-2">
                    <label class="" for='renavam'>Renavam</label>
                    <x-adminlte-input class="form-control" name='renavam' type='text' title='Informe o renavam do veículo' value="{{ $errors->all() ? old('renavam') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='chassi'>Chassi</label>
                    <x-adminlte-input class="form-control" name='chassi' type='text' title='Informe o chassi do veículo' value="{{ $errors->all() ? old('chassi') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2 mb-2">
                    <label class="" for='motor'>Motor</label>
                    <x-adminlte-input class="form-control" name='motor' type='text' title='Informe o motor do veículo' value="{{ $errors->all() ? old('motor') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='anomodelo'>Ano do Modelo</label>
                    <x-adminlte-input class="form-control" name='anomodelo' type='text' title='Informe o Ano do Modelo' value="{{ $errors->all() ? old('anomodelo') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="" for='anofabricacao'>Ano de Fabricação</label>
                    <x-adminlte-input class="form-control" name='anofabricacao' type='text' title='Informe o Ano de Fabricação' value="{{ $errors->all() ? old('anofabricacao') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='cidade'>Cidade</label>
                    <x-adminlte-input class="form-control" name='cidade' type='text' title='Informe a cidade do veículo' value="{{ $errors->all() ? old('cidade') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='uf'>UF</label>
                    <x-adminlte-input class="form-control" name='uf' type='text' title='Informe a sigla do estado para o veiculo' value="{{ $errors->all() ? old('uf') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='antt'>ANTT</label>
                    <x-adminlte-input class="form-control" name='antt' type='text' title='Informe a ANTT do veiculo' value="{{ $errors->all() ? old('uf') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2 mb-2">
                    <label class="" for='tara'>TARA(Kg)</label>
                    <x-adminlte-input class="form-control" name='tara' type='text' title='Informe a tara do veiculo' value="{{ $errors->all() ? old('tara') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='capacidade'>Capacidade(Kg)</label>
                    <x-adminlte-input class="form-control" name='capacidade' type='text' title='Informe a capacidade do veiculo' value="{{ $errors->all() ? old('capacidade') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='volume'>Volume(m³)</label>
                    <x-adminlte-input class="form-control" name='volume' type='text' title='Informe o volume do veiculo' value="{{ $errors->all() ? old('volume') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="" for='cor_id'>Cor</label>
                    <x-adminlte-select2 class="form-control" name="cor_id" title='Escolha a cor do veiculo'>
                        <option value="">Nenhum</option>
                        @forelse($cores as $cor)
                        <option value="{{$cor->id}}"{{ $errors->all() & (old('cor_id') == $cor->id) ? ' selected' : '' }}>{{$cor->cor}}</option>
                        @empty
                        <option value="">Nenhuma cor cadastrado</option> 
                        @endforelse
                    </x-adminlte-select2>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label class="" for='especie_id'>Especie</label>
                    <x-adminlte-select2 class="form-control" name="especie_id" title='Escolha a especie do veiculo'>
                        <option value="">Nenhum</option>
                        @forelse($especies as $especie)
                        <option value="{{$especie->id}}"{{ $errors->all() & (old('especie_id') == $especie->id) ? ' selected' : '' }} >{{$especie->especie}} </option>
                        @empty
                        <option value="">Nenhuma especie cadastrado</option> 
                        @endforelse
                    </x-adminlte-select2>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="" for='categoria_id'>Categoria</label>
                    <x-adminlte-select2 class="form-control" name="categoria_id" title='Escolha a categoria do veiculo'>
                        <option value="">Nenhum</option>
                        @forelse($categorias as $categoria)
                        <option value="{{$categoria->id}}"{{ $errors->all() & (old('categoria_id') == $categoria->id) ? ' selected' : '' }} >{{$categoria->categoria}} </option>
                        @empty
                        <option value="">Nenhuma categoria cadastrado</option> 
                        @endforelse
                    </x-adminlte-select2>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="" for='combustivel_id'>Combustível</label>
                    <x-adminlte-select2 class="form-control" name="combustivel_id" title='Escolha o combustivel do veiculo'>
                        <option value="">Nenhum</option>
                        @forelse($combustiveis as $combustivel)
                        <option value="{{$combustivel->id}}"{{ $errors->all() & (old('combustivel_id') == $combustivel->id) ? ' selected' : '' }} >{{$combustivel->combustivel}} </option>
                        @empty
                        <option value="">Nenhuma combustivel cadastrado</option> 
                        @endforelse
                    </x-adminlte-select2>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="" for='carroceria_id'>Carrocerias</label>
                    <x-adminlte-select2 class="form-control" name="carroceria_id" title='Escolha a carroceria do veiculo'>
                        <option value="">Nenhum</option>
                        @forelse($carrocerias as $carroceria)
                        <option value="{{$carroceria->id}}"{{ $errors->all() & (old('carroceria_id') == $carroceria->id) ? ' selected' : '' }} >{{$carroceria->carroceria}} </option>
                        @empty
                        <option value="">Nenhuma carroceria cadastrada</option> 
                        @endforelse
                    </x-adminlte-select2>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="" for='rodado_id'>Rodado</label>
                    <x-adminlte-select2 class="form-control" name="rodado_id" title='Escolha o rodado do veiculo'>
                        <option value="">Nenhum</option>
                        @forelse($rodados as $rodado)
                        <option value="{{$rodado->id}}"{{ $errors->all() & (old('rodado_id') == $rodado->id) ? ' selected' : '' }} >{{$rodado->rodado}} </option>
                        @empty
                        <option value="">Nenhuma rodado cadastrada</option> 
                        @endforelse
                    </x-adminlte-select2>
                </div> 
                <div class="col-md-2 mb-3">
                    <label class="" for='linha_id'>Linha</label>
                    <x-adminlte-select2 class="form-control" name="linha_id" title='Escolha a linha do veiculo'>
                        <option value="">Nenhum</option>
                        @forelse($linhas as $linha)
                        <option value="{{$linha->id}}"{{ $errors->all() & (old('linha_id') == $linha->id) ? ' selected' : '' }} >{{$linha->linha}} </option>
                        @empty
                        <option value="">Nenhuma linha cadastrada</option> 
                        @endforelse
                    </x-adminlte-select2>
                </div>  
            </div>
            <div class="form-row">

                <div class="col-md-2 mb-3">
                    <label class="" for='propriedade_id'>Propriedade</label>
                    <x-adminlte-select2 class="form-control" name="propriedade_id" title='Escolha a propriedade do veiculo'>
                        <option value="">Nenhum</option>
                        @forelse($propriedades as $propriedade)
                        <option value="{{$propriedade->id}}"{{ $errors->all() & (old('propriedade_id') == $propriedade->id) ? ' selected' : '' }} >{{$propriedade->propriedade}} </option>
                        @empty
                        <option value="">Nenhuma propriedade cadastrada</option> 
                        @endforelse
                    </x-adminlte-select2>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="" for='tipo_id'>Tipo</label>
                    <x-adminlte-select2 class="form-control" name="tipo_id" title='Escolha o tipo do veiculo'>
                        <option value="">Nenhum</option>
                        @forelse($tipos as $tipo)
                        <option value="{{$tipo->id}}"{{ $errors->all() & (old('tipo_id') == $tipo->id) ? ' selected' : '' }} >{{$tipo->tipo}} </option>
                        @empty
                        <option value="">Nenhuma tipo cadastrada</option> 
                        @endforelse
                    </x-adminlte-select2>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="" for='eixo_id'>Eixo</label>
                    <x-adminlte-select2 class="form-control" name="eixo_id" title='Escolha eixo do veiculo'>
                        <option value="">Nenhum</option>
                        @forelse($eixos as $eixo)
                        <option value="{{$eixo->id}}"{{ $errors->all() & (old('eixo_id') == $eixo->id) ? ' selected' : '' }} >{{$eixo->eixo}} </option>
                        @empty
                        <option value="">Nenhuma tipo  de eixo cadastrada</option> 
                        @endforelse
                    </x-adminlte-select2>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='cilindrada'>Cilindrada</label>
                    <x-adminlte-input class="form-control" name='cilindrada' type='text' title='Informe a cilindrada do veiculo' value="{{ $errors->all() ? old('cilindrada') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            <hr />
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label class="" for='cliente_id'>Cliente</label>
                    <x-adminlte-select2 class="form-control" name="cliente_id" title='Escolha o cliente'>
                        <option value="">Nenhum</option>
                        @forelse($clientes as $cliente)
                        <option value="{{$cliente->id}}"{{ $errors->all() & (old('cliente_id') == $cliente->id) ? ' selected' : '' }} >{{$cliente->nome}} </option>
                        @empty
                        <option value="">Nenhuma cliente cadastrado</option> 
                        @endforelse
                    </x-adminlte-select2>
                </div>
            </div>
            <div class="form-row">

                <div class="col-md-2 mb-2">
                    <label class="" for='valordobem'>Valor do Bem</label>
                    <x-adminlte-input class="form-control" name='valordobem' type='text' title='Informe o valor do veiculo' value="{{ $errors->all() ? old('valordobem') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='valorcompensado'>Valor Compensado</label>
                    <x-adminlte-input class="form-control" name='valorcompensado' type='text' title='Informe o valor compensado do veiculo' value="{{ $errors->all() ? old('valorcompensado') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='porcentagem'>Porcentagem</label>
                    <x-adminlte-input class="form-control" name='porcentagem' type='text' title='Informe o valor da porcentagem do veiculo' value="{{ $errors->all() ? old('porcentagem') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='franquia'>Franquia</label>
                    <x-adminlte-input class="form-control" name='franquia' type='text' title='Informe a franquia veiculo' value="{{ $errors->all() ? old('franquia') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='quotaparticipacao'>Quota Participação</label>
                    <x-adminlte-input class="form-control" name='quotaparticipacao' type='text' title='Informe a quota participação veiculo' value="{{ $errors->all() ? old('quotaparticipacao') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>      
            </div>
            <div class="form-row">
                <div class="col-md-2 mb-2">
                    <label class="" for='codigofipe'>Codigo Fipe</label>
                    <x-adminlte-input class="form-control" name='codigofipe' type='text' title='Informe o codigo fipe do veiculo' value="{{ $errors->all() ? old('codigofipe') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="" for='valorfipe'>Valor Fipe</label>
                    <x-adminlte-input class="form-control" name='valorfipe' type='text' title='Informe o valor fipe do veiculo' value="{{ $errors->all() ? old('valorfipe') : '' }}" />
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
            <hr />
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label class="" for='observacoes'>Observações</label>
                    <x-adminlte-textarea rows="5" class="form-control" name='observacoes' title='Informe as Observações'>{{ $errors->all() ? old('observacoes') : '' }}</x-adminlte-textarea>                                    
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>



            <input type="hidden" name="status" id="status" value="1" />

            <br />
            <div class="form-row">

                <div class="control-label col-sm-4" >
                    <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>

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