@extends('adminlte::page')

@section('content_header')
<h1>Ficha do Aluno</h1>
@stop

@section('content')
<div class="d-none d-print-block">
    <img style="width: 1500px" src="/logo.jpg" />
</div>
<br />
<div class="box box-solid box-footer" >
    <h3>1. DADOS DE IDENTIFICAÇÃO DA CRIANÇA</h3>
    <div class="box box-solid box-footer" >

        <div class="form-row ">
            <div class="col-md-3 mb-2">
                <label class="control-label" for='aluno_nome'>Nome:</label>
                <span class="col-lg-4">{{$aluno[0]->nome}}</span>
            </div>
            <div class="col-md-3 mb-2">
                <label class="control-label" for='cpf'>CPF:</label>
                <span class="col-lg-4">{{ $aluno[0]->cpf }}</span>
            </div>
            <div class="col-md-3 mb-2">
                <label class="control-label" for='aluno_nascimento'>Data de Nascimento:</label>
                <span class="col-lg-4">{{ date('d/m/Y', strtotime($aluno[0]->nascimento))}}</span>
            </div>

            <div class="col-md-3 mb-2">
                <label class="control-label" for='sexo'>Sexo:</label>
                <span class="col-lg-4">

                    @if ($aluno[0]->sexo == "M")
                    Masculino
                    @endif
                    @if ($aluno[0]->sexo == "F")
                    Feminino
                    @endif
                </span>
            </div>
        </div>
        <br>
        <h3>2. FILIAÇÃO</h3>
        <div class="box box-solid box-footer" >
            <div class="form-row ">
                <div class="col-md-3 mb-2">
                    <label class="control-label" for='nomepai'>Pai:</label>
                    <span class="col-lg-4"> {{ $aluno[0]->nomepai }}</span>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="control-label" for='numerotelefonepai'>Telefone:</label>
                    <span class="col-lg-4">{{$aluno[0]->numerotelefonepai}}</span>
                </div>


                <div class="col-md-3 mb-2">
                    <label class="control-label" for='nascimentopai'>Data de Nascimento:</label>
                    <span class="col-lg-4"> {{date('d/m/Y', strtotime($aluno[0]->nascimentopai))}}</span>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="control-label" for='cpfpai'>CPF:</label>
                    <span class="col-lg-4"> {{ $aluno[0]->cpfpai }}</span>
                </div>

                <div class="col-md-3 mb-2">
                    <label class="control-label" for='enderecopai'>Endereço:</label>
                    <span class="col-lg-4">{{$aluno[0]->enderecopai}}</span>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="control-label" for='bairropai'>Bairro:</label>
                    <span class="col-lg-3">{{$aluno[0]->bairropai}}</span>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="control-label" for='cidadepai'>Cidade:</label>
                    <span class="col-lg-3">{{$aluno[0]->cidadepai}}</span>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="control-label" for='estadopai'>Estado:</label>
                    <span class="col-lg-1">{{$aluno[0]->estadopai}}</span>
                </div>

                <div class="col-md-3 mb-2">	
                    <label class="control-label" for='emailpai'>E-mail:</label>
                    <span class="col-lg-10">{{ $aluno[0]->emailpai}}</span>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="control-label" for='trabalhopai'>Trabalho:</label>
                    <span class="col-lg-4">{{ $aluno[0]->trabalhopai}}</span>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="control-label" for='telefonetrabalhopai'>Telefone:</label>
                    <span class="col-lg-4">{{ $aluno[0]->numerotelefonepai}}</span>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="control-label" for='cargopai'>Cargo:</label>
                    <span class="col-lg-4">{{$aluno[0]->cargopai}}</span>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="control-label" for='horariopai'>Horário:</label>
                    <span class="col-lg-4">{{ $aluno[0]->horariopai}}</span>
                </div>
            </div>

            <div class="box box-solid box-footer" >
                <div class="form-row">
                    <div class="col-md-3 mb-2">
                        <label class="control-label" for='nomemae'>Mãe:</label>
                        <span class="col-lg-4">{{$aluno[0]->nomemae}}</span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="control-label" for='numerotelefonemae'>Telefone:</label>
                        <span class="col-lg-4">{{$aluno[0]->numerotelefonemae}}</span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="control-label" for='nascimentomae'>Data de Nascimento:</label>
                        <span class="col-lg-4">{{ date('d/m/Y', strtotime($aluno[0]->nascimentomae))}}</span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="control-label" for='cpfmae'>CPF:</label>
                        <span class="col-lg-4">{{ $aluno[0]->cpfmae}}</span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="control-label" for='enderecomae'>Endereço:</label>
                        <span class="col-lg-10"{{ $aluno[0]->enderecomae}}</span>
                    </div>
                    <div class="col-md-3 mb-2">	
                        <label class="control-label" for='bairromae'>Bairro:</label>
                        <span class="col-lg-3">{{$aluno[0]->bairromae}}</span>
                    </div>
                    <div class="col-md-3 mb-2">	
                        <label class="control-label" for='cidademae'>Cidade:</label>
                        <span class="col-lg-3">{{ $aluno[0]->cidademae}}</span>
                    </div>
                    <div class="col-md-3 mb-2">	
                        <label class="control-label" for='estadomae'>Estado:</label>
                        <span class="col-lg-1">{{ $aluno[0]->estadomae}}</span>
                    </div>
                </div>
                <div class="form-row">	
                    <div class="col-md-3 mb-2">	
                        <label class="control-label" for='emailmae'>E-mail:</label>
                        <span class="col-lg-10">{{ $aluno[0]->emailmae}}</span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="control-label" for='trabalhomae'>Trabalho:</label>
                        <span class="col-lg-4">{{ $aluno[0]->trabalhomae}}</span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="control-label" for='telefonetrabalhomae'>Telefone:</label>
                        <span class="col-lg-4">{{ $aluno[0]->numerotelefonemae}}</span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="control-label" for='cargomae'>Cargo:</label>
                        <span class="col-lg-4">{{$aluno[0]->cargomae}}</span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="control-label" for='horariomae'>Horário:</label>
                        <span class="col-lg-4">{{ $aluno[0]->horariomae}}</span>
                    </div>
                </div>
            </div>
            <br>
            <h3>3. OUTROS ELEMENTOS RELATIVOS A CRIANÇA</h3>

            <div class="box box-solid box-footer" >
                <div class="form-row">
                    <div class="col-md-3 mb-2">
                        <label class="control-label" for='relacaopais'>Relação entre Pai e Mãe:</label>
                        <span class="col-lg-3">
                            @if ($aluno[0]->relacaopais == "C") Casados @endif
                            @if ($aluno[0]->relacaopais == "D") Divorciados @endif
                            @if ($aluno[0]->relacaopais == "S") Solteiros @endif
                            @if ($aluno[0]->relacaopais == "U") União @endif
                        </span>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="control-label" for='cuidados'>Criança sob o cuidado de:</label>
                        <span class="col-lg-3">
                            @if ($aluno[0]->cuidados == "C") Pais (Casal) @endif
                            @if ($aluno[0]->cuidados == "P") Pai @endif
                            @if ($aluno[0]->cuidados == "M") Mãe @endif
                            @if ($aluno[0]->cuidados == "O") Outros @endif;
                        </span>
                    </div>
                </div>

                <div class="box box-solid box-footer" >
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label class="control-label" for='nomeresponsavel'>Responsável:</label>
                            <span class="col-lg-4"> {{$aluno[0]->nomeresponsavel}}</span>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="control-label" for='numerotelefoneresponsavel'>Telefone:</label>
                            <span class="col-lg-4">{{$aluno[0]->numerotelefoneresponsavel}}</span>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="control-label" for='nascimentoresponsavel'>Data de Nascimento:</label>
                            <span class="col-lg-4">{{ date('d/m/Y', strtotime($aluno[0]->nascimentoresponsavel))}}</span>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="control-label" for='cpfresponsavel'>CPF:</label>
                            <span class="col-lg-4">{{ $aluno[0]->cpfresponsavel}}</span>
                        </div>
                        <div class="col-md-3 mb-2">  
                            <label class="control-label " for='enderecoresponsavel'>Endereço:</label>
                            <span class="col-lg-10">{{ $aluno[0]->enderecoresponsavel}}</span>
                        </div>
                        <div class="col-md-3 mb-2">  
                            <label class="control-label " for='bairroresponsavel'>Bairro:</label>
                            <span class="col-lg-3">{{ $aluno[0]->bairroresponsavel}}</span>
                        </div>
                        <div class="col-md-3 mb-2">  
                            <label class="control-label"  for='cidaderesponsavel'>Cidade:</label>
                            <span class="col-lg-3">{{ $aluno[0]->cidaderesponsavel}}</span>
                        </div>
                        <div class="col-md-3 mb-2"> 
                            <label class="control-label" for='estadoresponsavel'>Estado:</label>
                            <span class="col-lg-1">{{ $aluno[0]->estadoresponsavel}}</span>
                        </div>
                        <div class="col-md-3 mb-2"> 
                            <label class="control-label" for='emailresponsavel'>E-mail:</label>
                            <span class="col-lg-10">{{ $aluno[0]->emailresponsavel}}</span>
                        </div>
                        <div class="col-md-3 mb-2"> 
                            <label class="control-label" for='trabalhoresponsavel'>Trabalho:</label>
                            <span class="col-lg-4">{{ $aluno[0]->trabalhoresponsavel}}</span>
                        </div>
                        <div class="col-md-3 mb-2"> 
                            <label class="control-label " for='telefonetrabalhoresponsavel'>Telefone do Trabalho:</label>
                            <span class="col-lg-4">{{ $aluno[0]->numerotelefoneresponsavel}}</span>
                        </div>
                        <div class="col-md-3 mb-2"> 
                            <label class="control-label " for='cargoresponsavel'>Cargo:</label>
                            <span class="col-lg-4">{{ $aluno[0]->cargoresponsavel}}</span>
                        </div>
                        <div class="col-md-3 mb-2"> 
                            <label class="control-label " for='horarioresponsavel'>Horário:</label>
                            <span class="col-lg-4">{{ $aluno[0]->horarioresponsavel}}</span>
                        </div>
                    </div>
                    <div class="box box-solid box-footer" >
                        <div class="form-row">
                            <div class="col-md-3 mb-2"> 
                                <label class="control-label" for='nomeresponsavelfinanceiro'>Responsável Financeiro:</label>
                                <span class="col-lg-4">{{ $aluno[0]->nomeresponsavelfinanceiro}}</span>
                            </div>
                            <div class="col-md-3 mb-2"> 
                                <label class="control-label" for='cpfresponsavelfinanceiro'>CPF:</label>
                                <span class="col-lg-4">{{ $aluno[0]->cpfresponsavelfinanceiro}}</span>
                            </div>
                            <div class="col-md-3 mb-2"> 
                                <label class="control-label" for='numerotelefoneresponsavelfinanceiro'>Telefone:</label>
                                <span class="col-lg-4">{{ $aluno[0]->numerotelefoneresponsavelfinanceiro}}</span>
                            </div>
                            <div class="col-md-3 mb-2"> 	
                                <label class="control-label" for='emailresponsavelfinanceiro'>E-mail:</label>
                                <span class="col-lg-10">{{ $aluno[0]->emailresponsavelfinanceiro}}</span>
                            </div>
                        </div>
                    </div>

                    <h4>Alimentação</h4>
                    <div class="box box-solid box-footer" >
                        <div class="form-row">	
                            <div class="col-md-10 mb-2"> 	
                                <label class="control-label" for='alimentacao'>Já faz alimentação de:</label>
                                <span class="col-lg-9">
                                    @if ($aluno[0]->papinhasalgada == "S") Papinha Salgada @endif
                                    @if ($aluno[0]->papinhasalgada == "S" && $aluno[0]->papinhadefrutas == "S") ,  @endif
                                    @if ($aluno[0]->papinhadefrutas == "S") Papinha de Frutas @endif
                                    @if ($aluno[0]->papinhasalgada == "S" && $aluno[0]->suco == "S" ||
                                    $aluno[0]->suco == "S" && $aluno[0]->papinhadefrutas == "S")
                                    ,  @endif
                                    @if ($aluno[0]->suco == "S") Suco @endif
                                    @if ($aluno[0]->papinhasalgada == "S" && $aluno[0]->outraalimentacao != "" ||
                                    $aluno[0]->outraalimentacao != "" && $aluno[0]->papinhadefrutas == "S" ||
                                    $aluno[0]->suco == "S" && $aluno[0]->outraalimentacao != "")
                                    ,  @endif
                                    @if ($aluno[0]->outraalimentacao != "") $aluno[0]->outraalimentacao @endif
                                </span>
                            </div>
                        </div>
                        <br>

                        <h3>4. SAÚDE</h3>
                        <div class="box box-solid box-footer" >
                            <div class="form-row">
                                <div class="col-md-3 mb-2"> 	
                                    <label class="control-label" for='cartaosus'>Número do Cartão SUS:</label>
                                    <span class="col-lg-4">
                                        {{$aluno[0]->cartaosus}}
                                    </span>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-3 mb-2"> 	
                                    <label class="control-label" for='planodesaude'>Plano de Saúde:</label>
                                    <span class="col-lg-4">
                                        @if ($aluno[0]->planodesaude == "S") {{$aluno[0]->nomeplanodesaude}} @endif
                                        @if ($aluno[0]->planodesaude == "N") Não @endif
                                    </span>
                                </div>
                                <div class="col-md-3 mb-2"> 	
                                    <label class="control-label" for='medicamentos'>Usa medicamentos:</label>
                                    <span class="col-lg-4">
                                        @if ($aluno[0]->medicamentos == "S") {{$aluno[0]->nomemedicamentos}} @endif
                                        @if ($aluno[0]->medicamentos == "N")  Não @endif
                                    </span>
                                </div>
                                <div class="col-md-3 mb-2"> 
                                    <label class="control-label" for='alergia'>Alergia:</label>
                                    <span class="col-lg-4">
                                        @if ($aluno[0]->alergia == "S")  {{$aluno[0]->nomealergia}} @endif
                                        @if ($aluno[0]->alergia == "N") Não @endif
                                    </span>
                                </div>
                                <div class="col-md-3 mb-2"> 
                                    <label class="control-label" for='problemasaude'>Problema de saúde:</label>
                                    <span class="col-lg-4">
                                        @if ($aluno[0]->problemasaude == "S") {{$aluno[0]->nomeproblemasaude}}  @endif
                                        @if ($aluno[0]->problemasaude == "N") Não @endif
                                    </span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="control-label" for='problemasaude'>Necessidades físicas especiais:</label>
                                    <span class="col-lg-6">
                                        @if ($aluno[0]->necessidadesfisicas == "S") {{$aluno[0]->nomenecessidadesfisicas}} @endif
                                        @if ($aluno[0]->necessidadesfisicas == "N") Não @endif
                                    </span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="control-label" for='oculos'>Usa óculos:</label>
                                    <span class="col-lg-4">                                  
                                        @if ($aluno[0]->oculos == "S") Sim @endif
                                        @if ($aluno[0]->oculos == "N") Não  @endif
                                    </span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="control-label" for='anemia'>Tem anemia:</label>
                                    <span class="col-lg-4">
                                        @if ($aluno[0]->anemia == "S") Sim @endif
                                        @if ($aluno[0]->anemia == "N") Não @endif
                                    </span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="control-label" for='diabetes'>Tem diabetes:</label>
                                    <span class="col-lg-4">
                                        @if ($aluno[0]->diabetes == "S") Sim @endif
                                        @if ($aluno[0]->diabetes == "N") Não @endif
                                    </span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="control-label" for='lactose'>Intolerância a lactose:</label>
                                    <span class="col-lg-4">
                                        @if ($aluno[0]->lactose == "S") Sim @endif
                                        @if ($aluno[0]->lactose == "N") Não @endif
                                    </span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="control-label" for='refluxo'>Tem refluxo:</label>
                                    <span class="col-lg-4">
                                        @if ($aluno[0]->refluxo == "S") Sim @endif
                                        @if ($aluno[0]->refluxo == "N") Não @endif
                                    </span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="control-label" for='gluten'>Intolerância a glúten:</label>
                                    <span class="col-lg-4">
                                        @if ($aluno[0]->gluten == "S") Sim @endif
                                        @if ($aluno[0]->gluten == "N") Não @endif
                                    </span>
                                </div>                                
                                <div class="col-md-3 mb-2">
                                    <label class="control-label" for='tiposanguineo'>Tipo Sanguineo:</label>
                                    <span class="col-lg-2">{{ $aluno[0]->tiposanguineo}}</span>
                                </div>                                
                                <div class="col-md-3 mb-2">
                                    <label class="control-label" for='peso'>Peso (kg):</label>
                                    <span class="col-lg-2">{{ $aluno[0]->peso}}</span>
                                </div>                               
                                <div class="col-md-3 mb-2">
                                    <label class="control-label" for='altura'>Altura (cm):</label>
                                    <span class="col-lg-2">{{ $aluno[0]->altura}}</span>
                                </div>
                            </div>
                        </div>

                        <h3>5. OUTRAS INFORMAÇÕES</h3>
                        <div class="box box-solid box-footer" >
                            <div class="form-row">
                                <div class="col-md-3 mb-2">
                                    <label class="control-label" for='observacoes'>Observações:</label>
                                    <span class="col-lg-10">{{ $aluno[0]->observacoes}}</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    @stop