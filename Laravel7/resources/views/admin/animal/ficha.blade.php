@extends('adminlte::page')

@section('content_header')
<h1>Ficha do Animal</h1>
@stop

@section('content')
<div class="row mb-3 callout callout-info" >
    <div class=" col-sm-6">
        <label class="col-sm-6" for='animal_nome'>Nome do Animal:</label>
        <span class="col-sm-6">{{$inseminacao[0]->nome}}</span>
    </div>
    <div class=" col-sm-6">
        <label class="col-sm-6" for='animal_numero'>Número do Animal:</label>
        <span class="col-sm-6">{{$inseminacao[0]->numero}}</span>
    </div>
    <div class=" col-sm-6">
        <label class="col-sm-6" for='animal_nascimento'>Data de Nascimento do Animal:</label>
        <span class="col-sm-6">{{date('d/m/Y', strtotime($inseminacao[0]->nascimento))}}</span>
    </div>
    <div class=" col-sm-6">
        <label class="col-sm-6" for='animal_sexo'>Sexo do Animal:</label>
        <span class="col-sm-6">
            @if ($inseminacao[0]->sexo == 'M') Macho @endif
            @if ($inseminacao[0]->sexo == 'F') Fêmea @endif
        </span>
    </div>
    <div class=" col-sm-6">
        <label class="col-sm-6" for='animal_mae'>Nome da Mãe:</label>
        <span class="col-sm-6">{{$inseminacao[0]->mae}}</span>
    </div>
    <div class=" col-sm-6">
        <label class="col-sm-6" for='animal_pai'>Número do Pai:</label>
        <span class="col-sm-6">{{$inseminacao[0]->pai}}</span>
    </div>
</div>

<div class="row callout callout-warning">
    <h3>Inseminações</h3>
    <table class="table table-striped table-hover table-responsive">
        <thead>
            <tr>
                <th class="text-center">Inseminação</th>
                <th class="text-center">Turno</th>
                <th class="text-center">Touro</th>
                <th class="text-center">Inseminador</th>
                <th class="text-center">Confirmação</th>
                <th class="text-center">Examinador</th>
                <th class="text-center">Fecundação</th>
                <th class="text-center">Parto</th>
                <th class="text-center">Acompanhante</th>
                <th class="text-center">Filhote</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inseminacao as $inseminacao)
            <tr>
                <td class="text-center">@if ($inseminacao->datainseminacao){{ date('d/m/Y', strtotime($inseminacao->datainseminacao)) }} @endif</td>
                <td class="text-center">
                    @if ($inseminacao->turno == 'M') Manhã @endif 
                    @if ($inseminacao->turno == 'T') Tarde @endif 
                </td>
                <td class="text-center">{{$inseminacao->touro}}</td>
                <td class="text-center">{{$inseminacao->inseminador}}</td>
                <td class="text-center"> @if ($inseminacao->dataconfirmacao) {{ date('d/m/Y', strtotime($inseminacao->dataconfirmacao)) }} @endif</td>
                <td class="text-center">{{$inseminacao->examinador}}</td>
                <td class="text-center">
                    @if ($inseminacao->status_gestacao == '0') <!--Aguardando-->
                    <span style="color:yellow" class="fas fa-clock" aria-hidden="true"></span>
                    @endif
                    @if ($inseminacao->status_gestacao == '1')  <!--Gestando-->
                    <span style="color:green" class="fas fa-check" aria-hidden="true"></span>
                    @endif
                    @if ($inseminacao->status_gestacao == '2') <!--Não fecundou ou finalizado-->
                    <span style="color:red" class="fas fa-" aria-hidden="true"></span>
                    @endif
                </td>
                <td class="text-center"> @if ($inseminacao->dataparto) {{ date('d/m/Y', strtotime($inseminacao->dataparto)) }} @endif</td>
                <td class="text-center">{{$inseminacao->acompanhante}}</td>
                <td class="text-center">
                    <a href="/animal/ficha/{{$inseminacao->filhote_id }}" title='Ficha do Animal'>
                        @forelse($animais as $animal)
                        @if($animal->id == $inseminacao->filhote_id) 
                        {{ $animal->nome }}
                        @endif
                        @empty
                        ''
                        @endforelse
                    </a>
                </td>
            </tr>
            @empty
            @endforelse 
        </tbody>
    </table>
</div>

<div class="row">

    <div class="col-md-6 callout callout-success">
        <h3>Vacinas</h3>
        <div class="mb-3 mt-3">
            <b>Total: {{ $totalvacinas }}</b>
        </div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th class="text-center">Vacina</th>
                    <th class="text-center">Data Vacinação</th>
                    <th class="text-center">Responsável</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vacinas as $vacina)
                <tr>
                    <td class="text-center">{{$vacina->nomevacina}}</td>
                    <td class="text-center">@if ($vacina->datavacina){{ date('d/m/Y', strtotime($vacina->datavacina)) }} @endif</td>
                    <td class="text-center">{{$vacina->name}}</td>
                </tr>
                @empty
                Não Vacinado
                @endforelse 
            </tbody>
        </table>
    </div>

    <div class="col-md-6 callout callout-danger">
        <h3>Produção de Leite</h3>
        <div class="mb-3 mt-3">
            <b>Média: {{ $mediaproducao }} litros</b>
        </div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th class="text-center">Quantidade</th>
                    <th class="text-center">Data de Produção</th>
                    <th class="text-center">Horário</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($producaos as $producao)
                <tr>
                    <td class="text-center">{{$producao->quantidade}}</td>
                    <td class="text-center">@if ($producao->data_producao){{ date('d/m/Y', strtotime($producao->data_producao)) }} @endif</td>
                    <td class="text-center">{{$producao->hora_producao}}</td>
                </tr>
                @empty
                Sem Produção
                @endforelse 
            </tbody>
        </table>
    </div>
    
</div>

@stop