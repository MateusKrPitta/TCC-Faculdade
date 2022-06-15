@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

@if(old('nome'))
@if(!$errors->all())
<div class="alert alert-success"> Adicionado: {{ old('nome') }}</div>
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
    <form class="needs-validation" name='FormularioEditarAluno' id='FormularioEditarAluno' action="/aluno/atualizar" enctype="application/x-www-form-urlencoded" method="post" >
        <fieldset title='Informações do Aluno' name='blocoform01' id='blocoform01'><legend>Informações do Aluno</legend>
            <input type="hidden" name="id" id="id" value="{{ $aluno->id }}" />
            <input type="hidden" name="_token" value=" {{ csrf_token() }} " />
            <div class="form-row">
                <div class="col-md-4 mb-2">
                    <label class="" for='nome'>Nome</label>
                    <x-adminlte-input class="form-control" name='nome' type='text' title='Coloque o nome do Aluno' value="{{ $errors->all() ? old('nome') : $aluno->nome }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="control-label" for='sexo'>Sexo</label>
                    <x-adminlte-select2 class="form-control" name="sexo" title='Escolha o sexo do cliente' >
                        <option value='M' {{ ($errors->all() & (old('sexo') == "M")) || ($aluno->sexo == "M") ? ' selected' : "" }} >Masculino</option>
                        <option value='F' {{ ($errors->all() & (old('sexo') == "F")) || ($aluno->sexo == "F") ? ' selected' : "" }} >Feminino</option> 
                        <option value='O' {{ ($errors->all() & (old('sexo') == "O")) || ($aluno->sexo == "O") ? ' selected' : "" }} >Outro</option> 
                    </x-adminlte-select2>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='nascimento'>Data de Nascimento</label>
                    <x-adminlte-input class="form-control" name='nascimento' type='date' title='Informe a data do nascimento do Aluno' value="{{ $errors->all() ? old('nascimento') : $aluno->nascimento }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="" for='cpf'>CPF</label>
                    <x-adminlte-input class="form-control" name='cpf' type='text' title='Informe o número do CPF' value="{{ $errors->all() ? old('cpf') : $aluno->cpf }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
        </fieldset>
        <br />
        <fieldset title='Informações dos Pais' name='blocoform01' id='blocoform01'><legend>Informações dos Pais</legend>
            <div style="color:darkblue">   
                <div class="form-row">                  
                    <div class="col-md-4 mb-2">
                        <label class="" for='nomepai'>Nome do Pai</label>
                        <x-adminlte-input class="form-control" name='nomepai' type='text' title='Coloque o nome do pai' value="{{ $errors->all() ? old('nomepai') : $aluno->nomepai }}"/>
                    </div>

                    <div class="col-sm-2  mb-2">
                        <label class="" for='numerotelefonepai'>Telefone</label>
                        <x-adminlte-input class="form-control" name='numerotelefonepai' type='text' title='Coloque o número do telefone do pai' value="{{ $errors->all() ? old('numerotelefonepai') : $aluno->numerotelefonepai }}"/>
                    </div>

                    <div class="col-md-3 mb-2">
                        <label class="" for='nascimentopai'>Data de Nascimento</label>
                        <x-adminlte-input class="form-control" name='nascimentopai' type='date' title='Informe a data do nascimento do Aluno' value="{{ $errors->all() ? old('nascimentopai') : $aluno->nascimentopai }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>

                    <div class="col-md-3 mb-2">
                        <label class="" for='cpfpai'>CPF</label>
                        <x-adminlte-input class="form-control" name='cpfpai' type='text' title='Informe o número do CPF' value="{{ $errors->all() ? old('cpfpai') : $aluno->cpfpai }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-5 mb-2">
                        <label class="" for='enderecopai'>Endereço do Pai</label>
                        <x-adminlte-input class="form-control" name='enderecopai' type='text' title='Informe o endereço do pai' value="{{ $errors->all() ? old('enderecopai') : $aluno->enderecopai }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="" for='bairropai'>Bairro</label>
                        <x-adminlte-input class="form-control" name='bairropai' type='text' title='Informe o bairro' value="{{ $errors->all() ? old('bairropai') : $aluno->bairropai }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="" for='cidadepai'>Cidade</label>
                        <x-adminlte-input class="form-control" name='cidadepai' type='text' title='Informe a cidade' value="{{ $errors->all() ? old('cidadepai') : $aluno->cidadepai }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-1 mb-2">
                        <label class="" for='estadopai'>Estado</label>
                        <x-adminlte-input class="form-control" name='estadopai' type='text' size='2' title='Informe o Estado' value="{{ $errors->all() ? old('estadopai') : $aluno->estadopai }}"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-4 mb-2">
                        <label class="" for='emailpai'>E-Mail</label>
                        <x-adminlte-input class="form-control" name='emailpai' type='email' size='180' title='Informe o endereço eletrônico' value="{{ $errors->all() ? old('emailpai') : $aluno->emailpai }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-4 mb-2">
                        <label class="" for='trabalhopai'>Local de Trabalho</label>
                        <x-adminlte-input class="form-control " name='trabalhopai' type='text' title='Coloque o nome do local de trabalho do pai' value="{{ $errors->all() ? old('trabalhopai') : $aluno->trabalhopai}}"/> 
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="" for='horariopai'>Horário de Trabalho</label>
                        <x-adminlte-input class="form-control" name='horariopai' type='text'  placeholder="Dia Inteiro, manhã, tarde ou noite" title='Coloque o horário de trabalho do pai' value="{{ $errors->all() ? old('horariopai') : $aluno->horariopai }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-2 mb-2">
                        <label class="" for='telefonetrabalhopai'>Telefone Trabalho</label>
                        <x-adminlte-input class="form-control" name='telefonetrabalhopai' type='text' title='Coloque o número do telefone do local de trabalho do pai' value="{{ $errors->all() ? old('telefonetrabalhopai') : $aluno->telefonetrabalhopai }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="" for='cargopai'>Cargo</label>
                        <x-adminlte-input class="form-control" name='cargopai' type='text' title='Coloque o cargo do pai' value="{{ $errors->all() ? old('cargopai') : $aluno->cargopai }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>
            </div>

            <div style="color:red">  
                <div class="form-row">                 
                    <div class="col-md-4 mb-2">
                        <label class="" for='nomemae'>Nome da Mãe</label>
                        <x-adminlte-input class="form-control" name='nomemae' type='text' title='Coloque o nome da Mãe' value="{{ $errors->all() ? old('nomemae') : $aluno->nomemae }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-2  mb-2">
                        <label class="" for='numerotelefonemae'>Telefone</label>
                        <x-adminlte-input class="form-control" name='numerotelefonemae' type='text' title='Coloque o número do telefone da Mãe' value="{{ $errors->all() ? old('numerotelefonemae') : $aluno->numerotelefonemae }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="" for='nascimentomae'>Data de Nascimento</label>
                        <x-adminlte-input class="form-control" name='nascimentomae' type='date' title='Informe a data do nascimento da Mãe' value="{{ $errors->all() ? old('nascimentomae') : $aluno->nascimentomae }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="" for='cpfmae'>CPF</label>
                        <x-adminlte-input class="form-control" name='cpfmae' type='text' title='Informe o número do CPF' value="{{ $errors->all() ? old('cpfmae') : $aluno->cpfmae }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-5 mb-2">
                        <label class="" for='enderecomae'>Endereço da Mãe</label>
                        <x-adminlte-input class="form-control" name='enderecomae' type='text' title='Informe o endereço do Mãe' value="{{ $errors->all() ? old('enderecomae') : $aluno->enderecomae }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="" for='bairromae'>Bairro</label>
                        <x-adminlte-input class="form-control" name='bairromae' type='text' title='Informe o nome do bairro' value="{{ $errors->all() ? old('bairromae') : $aluno->bairromae }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="" for='cidademae'>Cidade</label>
                        <x-adminlte-input class="form-control" name='cidademae' type='text' title='Informe o nome da cidade' value="{{ $errors->all() ? old('cidademae') : $aluno->cidademae }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-1 mb-2">
                        <label class="control-label col-sm-1" for='estadomae'>Estado</label>
                        <x-adminlte-input class="form-control" name='estadomae' type='text' size='2' title='Informe o Estado' value="{{ $errors->all() ? old('estadomae') : $aluno->estadomae }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-4 mb-2">
                        <label class="" for='emailmae'>E-Mail</label>
                        <x-adminlte-input class="form-control" name='emailmae' type='email' size='180' title='Informe o endereço eletrônico' value="{{ $errors->all() ? old('emailmae') : $aluno->emailmae }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-4 mb-2">
                        <label class="" for='trabalhomae'>Local de Trabalho</label>
                        <x-adminlte-input class="form-control " name='trabalhomae' type='text' title='Coloque o nome do local de trabalho do mae' value="{{ $errors->all() ? old('trabalhomae') : $aluno->trabalhomae }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="" for='horariomae'>Horário de trabalho</label>
                        <x-adminlte-input class="form-control" name='horariomae' type='text' title='Coloque o horário de trabalho do pai' value="{{ $errors->all() ? old('horariomae') : $aluno->horariomae }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-2 mb-2">
                        <label class="" for='telefonetrabalhomae'>Telefone Trabalho</label>
                        <x-adminlte-input class="form-control" name='telefonetrabalhomae' type='text' title='Coloque o número do telefone do local de trabalho da mae' value="{{ $errors->all() ? old('telefonetrabalhomae') : $aluno->telefonetrabalhomae }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="" for='cargomae'>Cargo</label>
                        <x-adminlte-input class="form-control" name='cargomae' type='text' title='Coloque o cargo da mae' value="{{ $errors->all() ? old('cargomae') : $aluno->cargomae }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>
            </div>
        </fieldset>	
        <br />
        <fieldset title='OutrasInformacoes' name='blocoform01' id='blocoform01'><legend>Outras Informações</legend>
            <div class="form-row">
                <div class="col-md-6 ">
                    <label class="" for='relacaopais'>Relação entre Pai e Mãe</label>
                    <x-adminlte-select2 name="relacaopais" class="form-control">
                        <option value="C" {{ ($errors->all() & (old('relacaopais') == "C")) || ($aluno->relacaopais == "C") ? ' selected' : "" }} >Casados</option>
                        <option value="D" {{ ($errors->all() & (old('relacaopais') == "D")) || ($aluno->relacaopais == "D") ? ' selected' : "" }} >Divorciados</option>
                        <option value="S" {{ ($errors->all() & (old('relacaopais') == "S")) || ($aluno->relacaopais == "S") ? ' selected' : "" }} >Solteiros</option>
                        <option value="U" {{ ($errors->all() & (old('relacaopais') == "U")) || ($aluno->relacaopais == "U") ? ' selected' : "" }} >União Estável</option>
                    </x-adminlte-select2>
                </div>
                <div class="col-md-6">
                    <label class="" for='cuidados'>Criança sob os cuidados</label>
                    <x-adminlte-select2 name="cuidados" class="form-control">
                        <option value="C" {{ ($errors->all() & (old('cuidados') == "C")) || ($aluno->cuidados == "C") ? ' selected' : "" }}>Casal</option>
                        <option value="P" {{ ($errors->all() & (old('cuidados') == "P")) || ($aluno->cuidados == "P") ? ' selected' : "" }}>Pai</option>
                        <option value="M" {{ ($errors->all() & (old('cuidados') == "M")) || ($aluno->cuidados == "M") ? ' selected' : "" }}>Mãe</option>
                        <option value="O" {{ ($errors->all() & (old('cuidados') == "O")) || ($aluno->cuidados == "O") ? ' selected' : "" }}>Outros</option>
                    </x-adminlte-select2>
                </div>
            </div>
            <br></br>
            <div style="color:darkgreen">   
                <div class="form-row">
                    <div class="col-md-4 mb-2">
                        <label class="" for='nomeresponsavel'>Nome do Responsável</label>
                        <x-adminlte-input class="form-control" name='nomeresponsavel' type='text' title='Coloque o nome do responsavel ' value="{{ $errors->all() ? old('nomeresponsavel') : $aluno->nomeresponsavel }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="" for='numerotelefoneresponsavel'>Telefone</label>
                        <x-adminlte-input class="form-control" name='numerotelefoneresponsavel' type='text' title='Informe o número do Responsavel' value="{{ $errors->all() ? old('numerotelefoneresponsavel') : $aluno->numerotelefoneresponsavel }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="" for='nascimentoresponsavel'>Data de Nascimento</label>
                        <x-adminlte-input class="form-control" name='nascimentoresponsavel' type='date' title='Informe a data do nascimento do responsavel' value="{{ $errors->all() ? old('nascimentoresponsavel') : $aluno->nascimentoresponsavel }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="" for='cpfresponsavel'>CPF</label>
                        <x-adminlte-input class="form-control" name='cpfresponsavel' type='text' title='Informe o número do CPF' value="{{ $errors->all() ? old('cpfresponsavel') : $aluno->cpfresponsavel }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-md-5 mb-2">
                        <label class="" for='enderecoresponsavel'>Endereço</label>
                        <x-adminlte-input class="form-control" name='enderecoresponsavel' type='text'  title='Informe o nome do Logradouro' value="{{ $errors->all() ? old('enderecoresponsavel') : $aluno->enderecoresponsavel }}" placeholder="Rua"/> 
                        <div class="valid-feedback">Certo!</div>
                    </div>      
                    <div class="col-md-3 mb-2">
                        <label class="" for='bairroresponsavel'>Bairro</label>
                        <x-adminlte-input class="form-control" name='bairroresponsavel' type='text'  title='Informe o nome do Bairro' value="{{ $errors->all() ? old('bairroresponsavel') : $aluno->bairroresponsavel }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="" for='cidaderesponsavel'>Cidade</label>
                        <x-adminlte-input class="form-control" name='cidaderesponsavel' type='text'  title='Informe o nome da Cidade' value="{{ $errors->all() ? old('cidaderesponsavel') : $aluno->cidaderesponsavel }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-sm-1 mb-2">
                        <label class="" for='estadoresponsavel'>Estado</label>
                        <x-adminlte-input class="form-control" name='estadoresponsavel' type='text' size='2' title='Informe o Estado' value="{{ $errors->all() ? old('estadoresponsavel') : $aluno->estadoresponsavel }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-2">
                        <label class="" for='emailresponsavel'>E-Mail</label>
                        <x-adminlte-input class="form-control " name='emailresponsavel' type='email' size='180' title='Informe o email' value="{{ $errors->all() ? old('emailresponsavel') : $aluno->emailresponsavel }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-2">
                        <label class="" for='trabalhoresponsavel'>Local de Trabalho</label>
                        <x-adminlte-input class="form-control" name='trabalhoresponsavel' type='text'  title='Informe o local de trabalho' value="{{ $errors->all() ? old('trabalhoresponsavel') : $aluno->trabalhoresponsavel }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="" for='horarioresponsavel'>Horário de Trabalho</label>
                        <x-adminlte-input class="form-control" name='horarioresponsavel' type='text'  title='Informe o horario de trabalho' value="{{ $errors->all() ? old('horarioresponsavel') : $aluno->horarioresponsavel }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="" for='telefonetrabalhoresponsavel'>Telefone Trabalho</label>
                        <x-adminlte-input class="form-control" name='telefonetrabalhoresponsavel' type='text'  title='Informe o local de trabalho' value="{{ $errors->all() ? old('telefonetrabalhoresponsavel') : $aluno->telefonetrabalhoresponsavel }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="" for='cargoresponsavel'>Cargo</label>
                        <x-adminlte-input class="form-control" name='cargoresponsavel' type='text'  title='Informe o cargo' value="{{ $errors->all() ? old('cargoresponsavel') : $aluno->cargoresponsavel }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>
                </div>
                <br></br>
            </div>

            <div style="color:darkblue">
                <div class="form-row">
                    <div class="col-md-4 mb-2">
                        <label class="" for='nomeresponsavelfinanceiro'>Responsável Financeiro</label>
                        <x-adminlte-input class="form-control" name='nomeresponsavelfinanceiro' type='text'  title='Informe o cargo' value="{{ $errors->all() ? old('nomeresponsavelfinanceiro') : $aluno->nomeresponsavelfinanceiro }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>

                    <div class="col-md-2 mb-2">
                        <label class="" for='numerotelefoneresponsavelfinanceiro'>Número Telefone</label>
                        <x-adminlte-input class="form-control" name='numerotelefoneresponsavelfinanceiro' type='text'  title='Informe o Número do telefone do financeiro' value="{{ $errors->all() ? old('numerotelefoneresponsavelfinanceiro') : $aluno->numerotelefoneresponsavelfinanceiro }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>

                    <div class="col-md-2 mb-2">
                        <label class="" for='cpfresponsavelfinanceiro'>CPF </label>
                        <x-adminlte-input class="form-control" name='cpfresponsavelfinanceiro' type='text'  title='Informe o cpf' value="{{ $errors->all() ? old('cpfresponsavelfinanceiro') : $aluno->cpfresponsavelfinanceiro }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <label class="" for='emailresponsavelfinanceiro'>E-Mail</label>
                        <x-adminlte-input class="form-control" name='emailresponsavelfinanceiro' type='email' title='Informe o email' value="{{ $errors->all() ? old('emailresponsavelfinanceiro') : $aluno->emailresponsavelfinanceiro }}"/>
                        <div class="valid-feedback">Certo!</div>
                    </div> 
                </div>
            </div>
        </fieldset>

        <fieldset title='reacoesdacrianca' name='blocoform01' id='blocoform01'><legend>Alimentação</legend>	
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label class="" for='papinhasalgada'>Papinha salgada</label>
                    <x-adminlte-select2 name="papinhasalgada" class="form-control col-md-7">
                        <option value="S" {{ ($errors->all() & (old('papinhasalgada') == "S")) || ($aluno->papinhasalgada == "S") ? ' selected' : "" }}>Sim</option>
                        <option value="N" {{ ($errors->all() & (old('papinhasalgada') == "N")) || ($aluno->papinhasalgada == "N") ? ' selected' : "" }}>Não</option>
                    </x-adminlte-select2>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="" for='papinhadefrutas'>Papinha de frutas</label>
                    <x-adminlte-select2 name="papinhadefrutas" class="form-control col-md-7">
                        <option value="S" {{ ($errors->all() & (old('papinhadefrutas') == "S")) || ($aluno->papinhadefrutas == "S") ? ' selected' : "" }}>Sim</option>
                        <option value="N" {{ ($errors->all() & (old('papinhadefrutas') == "N")) || ($aluno->papinhadefrutas == "N") ? ' selected' : "" }}>Não</option>
                    </x-adminlte-select2>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="" for='suco'>Suco</label>
                    <x-adminlte-select2 name="suco" class="form-control col-md-7">
                        <option value="S" {{ ($errors->all() & (old('suco') == "S")) || ($aluno->suco == "S") ? ' selected' : "" }}>Sim</option>
                        <option value="N" {{ ($errors->all() & (old('suco') == "N")) || ($aluno->suco == "N") ? ' selected' : "" }}>Não</option>
                    </x-adminlte-select2>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="" for='outraalimentacao'>Outros</label>
                    <x-adminlte-input class="form-control" name='outraalimentacao' type='text'  title='Coloque outra alimentação' value="{{ $errors->all() ? old('outraalimentacao') : $aluno->outraalimentacao }}"/>
                    <div class="valid-feedback">Certo!</div>
                </div>
            </div>
        </fieldset>
        <br />
        <div style="color:red">
            <fieldset title='saude' name='blocoform01' id='blocoform01'><legend>Saúde</legend>
                <div class="form-row">
                    <div class="col-md-8 mb-3">
                        <label class="" for='cartaosus'>Número do Cartão SUS</label>
                        <x-adminlte-input class="form-control" name='cartaosus' type='text' title='Coloque o número do cartão SUS' value="{{ $errors->all() ? old('cartaosus') : $aluno->cartaosus }}" />
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="" for='planodesaude'>Plano de Saúde?</label>
                        <x-adminlte-select2 name="planodesaude" class="form-control">
                            <option value="S" {{ ($errors->all() & (old('planodesaude') == "S")) || ($aluno->planodesaude == "S") ? ' selected' : "" }}>Sim</option>
                            <option value="N" {{ ($errors->all() & (old('planodesaude') == "N")) || ($aluno->planodesaude == "N") ? ' selected' : "" }}>Não</option>
                        </x-adminlte-select2>
                    </div>   
                    <div class="col-md-8 mb-3">
                        <label class="" for='nomeplanodesaude'>Qual?</label>
                        <x-adminlte-input class="form-control" name='nomeplanodesaude' type='text' title='Coloque o nome do Plano de Saúde' value="{{ $errors->all() ? old('nomeplanodesaude') : $aluno->nomeplanodesaude }}" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="" for='medicamentos'>Usa medicamentos?</label>
                        <x-adminlte-select2 name="medicamentos" class="form-control">
                            <option value="S" {{ ($errors->all() & (old('medicamentos') == "S")) || ($aluno->medicamentos == "S") ? ' selected' : "" }}>Sim</option>
                            <option value="N" {{ ($errors->all() & (old('medicamentos') == "N")) || ($aluno->medicamentos == "N") ? ' selected' : "" }}>Não</option>
                        </x-adminlte-select2>
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="" for='nomemedicamentos'>Quais?</label>
                        <x-adminlte-input class="form-control" name='nomemedicamentos' type='text' title='Coloque o nome dos medicamentos' value="{{ $errors->all() ? old('nomemedicamentos') : $aluno->nomemedicamentos }}" />
                    </div>
                </div>
                <div class="form-row">     
                    <div class="col-md-4 mb-3">
                        <label class="" for='alergia'>Possui alergia a medicamentos?</label>
                        <x-adminlte-select2 name="alergia" class="form-control">
                            <option value="S" {{ ($errors->all() & (old('alergia') == "S")) || ($aluno->alergia == "S") ? ' selected' : "" }}>Sim</option>
                            <option value="N" {{ ($errors->all() & (old('alergia') == "N")) || ($aluno->alergia == "N") ? ' selected' : "" }}>Não</option>
                        </x-adminlte-select2>
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="" for='nomealergia'>Quais?</label>
                        <x-adminlte-input class="form-control" name='nomealergia' type='text' title='Coloque o que causa a alergia.' value="{{ $errors->all() ? old('nomealergia') : $aluno->nomealergia }}" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="" for='alergiaalimento'>Possui alergia a alimentos?</label>
                        <x-adminlte-select2 name="alergiaalimento" class="form-control">
                            <option value="S" {{ ($errors->all() & (old('alergiaalimento') == "S")) || ($aluno->alergiaalimento == "S") ? ' selected' : "" }}>Sim</option>
                            <option value="N" {{ ($errors->all() & (old('alergiaalimento') == "N")) || ($aluno->alergiaalimento == "N") ? ' selected' : "" }}>Não</option>
                        </x-adminlte-select2>
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="" for='nomealergiaalimento'>Quais?</label>
                        <x-adminlte-input class="form-control" name='nomealergiaalimento' type='text' title='Coloque o que causa a alergia.' value="{{ $errors->all() ? old('nomealergiaalimento') : $aluno->nomealergiaalimento }}" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="" for='problemasaude'>Possui problemas de saúde?</label>
                        <x-adminlte-select2 name="problemasaude" class="form-control">
                            <option value="S" {{ ($errors->all() & (old('problemasaude') == "S")) || ($aluno->problemasaude == "S") ? ' selected' : "" }}>Sim</option>
                            <option value="N" {{ ($errors->all() & (old('problemasaude') == "N")) || ($aluno->problemasaude == "N") ? ' selected' : "" }}>Não</option>
                        </x-adminlte-select2>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label class="" for='nomeproblemasaude'>Quais?</label>
                        <x-adminlte-input class="form-control" name='nomeproblemasaude' type='text' title='Coloque o problema de saúde.' value="{{ $errors->all() ? old('nomeproblemasaude') : $aluno->nomeproblemasaude }}" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="" for='necessidadesfisicas'>Necessidades Físicas Especiais?</label>
                        <x-adminlte-select2 name="necessidadesfisicas" class="form-control">
                            <option value="S" {{ ($errors->all() & (old('necessidadesfisicas') == "S")) || ($aluno->necessidadesfisicas == "S") ? ' selected' : "" }}>Sim</option>
                            <option value="N" {{ ($errors->all() & (old('necessidadesfisicas') == "N")) || ($aluno->necessidadesfisicas == "N") ? ' selected' : "" }}>Não</option>
                        </x-adminlte-select2>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label class="" for='nomenecessidadesfisicas'>Qual?</label>
                        <x-adminlte-input class="form-control" name='nomenecessidadesfisicas' type='text' title='Coloque a descrição da necessidade.' value="{{ $errors->all() ? old('nomenecessidadesfisicas') : $aluno->nomenecessidadesfisicas }}" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="" for='oculos'>Usa Óculos?</label>
                        <x-adminlte-select2 name="oculos" class="form-control">
                            <option value="S" {{ ($errors->all() & (old('oculos') == "S")) || ($aluno->oculos == "S") ? ' selected' : "" }}>Sim</option>
                            <option value="N" {{ ($errors->all() & (old('oculos') == "N")) || ($aluno->oculos == "N") ? ' selected' : "" }}>Não</option>
                        </x-adminlte-select2>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="" for='anemia'>Possui Anemia?</label>
                        <x-adminlte-select2 name="anemia" class="form-control">
                            <option value="S" {{ ($errors->all() & (old('anemia') == "S")) || ($aluno->anemia == "S") ? ' selected' : "" }}>Sim</option>
                            <option value="N" {{ ($errors->all() & (old('anemia') == "N")) || ($aluno->anemia == "N") ? ' selected' : "" }}>Não</option>
                        </x-adminlte-select2>
                    </div>
                    <div class="col-md-4 mb-3 ">
                        <label class="" for='diabetes'>Diabetes?</label>
                        <x-adminlte-select2 name="diabetes" class="form-control">
                            <option value="S" {{ ($errors->all() & (old('diabetes') == "S")) || ($aluno->diabetes == "S") ? ' selected' : "" }}>Sim</option>
                            <option value="N" {{ ($errors->all() & (old('diabetes') == "N")) || ($aluno->diabetes == "N") ? ' selected' : "" }}>Não</option>
                        </x-adminlte-select2>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="" for='lactose'>Intolerância a Lactose?</label>
                        <x-adminlte-select2 name="lactose" class="form-control">
                            <option value="S" {{ ($errors->all() & (old('lactose') == "S")) || ($aluno->lactose == "S") ? ' selected' : "" }}>Sim</option>
                            <option value="N" {{ ($errors->all() & (old('lactose') == "N")) || ($aluno->lactose == "N") ? ' selected' : "" }}>Não</option>
                        </x-adminlte-select2>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="" for='refluxo'>Refluxo?</label>
                        <x-adminlte-select2 name="refluxo" class="form-control">
                            <option value="S" {{ ($errors->all() & (old('refluxo') == "S")) || ($aluno->refluxo == "S") ? ' selected' : "" }}>Sim</option>
                            <option value="N" {{ ($errors->all() & (old('refluxo') == "N")) || ($aluno->refluxo == "N") ? ' selected' : "" }}>Não</option>
                        </x-adminlte-select2>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="" for='gluten'>Intolerância a Gluten?</label>
                        <x-adminlte-select2 name="gluten" class="form-control">
                            <option value="S" {{ ($errors->all() & (old('gluten') == "S")) || ($aluno->gluten == "S") ? ' selected' : "" }}>Sim</option>
                            <option value="N" {{ ($errors->all() & (old('gluten') == "N")) || ($aluno->gluten == "N") ? ' selected' : "" }}>Não</option>
                        </x-adminlte-select2>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label class="" for='tiposanguineo'>Tipo Sanguineo</label>
                        <x-adminlte-select2 name="tiposanguineo" class="form-control">
                            <option value="O+" {{ ($errors->all() & (old('tiposanguineo') == "O+")) || ($aluno->tiposanguineo == "O+") ? ' selected' : "" }} >O+</option>
                            <option value="O-" {{ ($errors->all() & (old('tiposanguineo') == "O-")) || ($aluno->tiposanguineo == "O-") ? ' selected' : "" }} >O-</option>
                            <option value="A+" {{ ($errors->all() & (old('tiposanguineo') == "A+")) || ($aluno->tiposanguineo == "A+") ? ' selected' : "" }} >A+</option>
                            <option value="A-" {{ ($errors->all() & (old('tiposanguineo') == "A-")) || ($aluno->tiposanguineo == "A-") ? ' selected' : "" }} >A-</option>
                            <option value="B+" {{ ($errors->all() & (old('tiposanguineo') == "B+")) || ($aluno->tiposanguineo == "B+") ? ' selected' : "" }} >B+</option>
                            <option value="B-" {{ ($errors->all() & (old('tiposanguineo') == "B-")) || ($aluno->tiposanguineo == "B-") ? ' selected' : "" }} >B-</option>
                            <option value="AB+" {{ ($errors->all() & (old('tiposanguineo') == "AB+")) || ($aluno->tiposanguineo == "AB+") ? ' selected' : "" }} >AB+</option>
                            <option value="AB-" {{ ($errors->all() & (old('tiposanguineo') == "AB-")) || ($aluno->tiposanguineo == "AB-") ? ' selected' : "" }} >AB-</option>
                        </x-adminlte-select2>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="" for='peso'>Peso em gramas(1000g = 1kg)</label>
                        <x-adminlte-input class="form-control" name='peso' type='number' title='Coloque o peso em gramas' value="{{ $errors->all() ? old('peso') : $aluno->peso }}" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="" for='altura'>Altura(cm)</label>
                        <x-adminlte-input class="form-control" name='altura' type='number' title='Coloque a altura em centímetros.' value="{{ $errors->all() ? old('altura') : $aluno->altura }}"/>
                    </div>
                </div>
            </fieldset>

            <fieldset title='Outras Informações' name='blocoform01' id='blocoform01'><legend>Outras Informações</legend>
                <div style="color:blue">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label class="" for='autorizabuscaraluno'>Autoriza alguém a buscar o aluno?</label>
                            <x-adminlte-select2 name="autorizabuscaraluno" class="form-control">
                                <option value="S" {{ ($errors->all() & (old('autorizabuscaraluno') == "S")) || ($aluno->autorizabuscaraluno == "S") ? ' selected' : "" }}>Sim</option>
                                <option value="N" {{ ($errors->all() & (old('autorizabuscaraluno') == "N")) || ($aluno->autorizabuscaraluno == "N") ? ' selected' : "" }}>Não</option>
                            </x-adminlte-select2>
                        </div>   
                        <div class="col-md-8 mb-3">
                            <label class="" for='autorizabuscaralunonome'>Nome, telefone e documento da pessoa autorizada</label>
                            <x-adminlte-input class="form-control" name='autorizabuscaralunonome' type='text' title='Coloque o nome, telefone e documento da pessoa autorizada a buscar o aluno' value="{{ $errors->all() ? old('autorizabuscaralunonome') : $aluno->autorizabuscaralunonome }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" for='observacoes'>Observações</label>
                        <div class="col-md-12">
                            <x-adminlte-textarea class="form-control col-md-12" name='observacoes' type='text' rows="5" cols="33"  title='Coloque detalhes adicionais'>{{ $errors->all() ? old('observacoes') : $aluno->observacoes }}</x-adminlte-textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="control-label col-md-4" >
                            <button class="btn btn-lg btn-success btn-block" type='submit' id='botaogravar' title='Aperte este botão para gravar os dados.'>Gravar</button>
                        </div>
                    </div>
                </div>
            </fieldset>
    </form>
    <br /><br />
</div>

@stop

