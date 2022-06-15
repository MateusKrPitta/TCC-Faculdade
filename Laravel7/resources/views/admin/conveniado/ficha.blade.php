@extends('adminlte::page')

@section('content_header')
<h1>Ficha do Conveniado</h1>
@stop

@section('content')

<div class="form-row">
    <div class="col-md-2 mb-1">
        <label class="" for='imagem'>Fotografia</label>
        <img id="imagem"
             name="imagem"
             src="{{Storage::url('imagem.png')}}"
             width="100%"/>
    </div>
    <div class="col-md-10 mb-1  {{ $conveniado->status == "1" ? '' : 'text-danger' }}">
        <div class="form-row">

            <div class="col-md-4 mb-1">
                <p><span><b>Cartão: </b></span><span>{{ $conveniado->numeronocartao }}</span></p>
            </div>
            <div class="col-md-4 mb-1">
                <p><span><b>Validade do Cartão: </b></span><span>{{ implode('/', array_reverse(explode('-', $conveniado->datadevalidade)))}}</span></p>
            </div>
            <div class="col-md-4 mb-1">
                <p><span><b>Situação: </b></span><span>{{ $conveniado->status == "1" ? 'Ativo' : 'Bloqueado' }}</span></p>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-8 mb-1">
                <p><span><b>Nome: </b></span><span>{{ $conveniado->nome }}</span></p>
            </div>
            <div class="col-md-4 mb-1">
                <p><span><b>Cadastrado em: </b></span><span>{{ date('d/m/Y',strtotime($conveniado->cadastro)) }}</span></p>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-1">
                <p><span><b>CPF: </b></span><span>{{ $conveniado->cpfcnpj }}</span></p>
            </div>
            <div class="col-md-4 mb-1">
                <p><span><b>RG: </b></span><span>{{ $conveniado->rgie }}</span></p>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-1">
                <p><span><b>Parentesco: </b></span><span>{{ $conveniado->parentesco_nome }}</span></p>
            </div>
            <div class="col-md-4 mb-1">
                <p><span><b>Data de Nascimento: </b></span><span>{{ implode('/', array_reverse(explode('-', $conveniado->nascimento))) }}</span></p>
            </div>
            <div class="col-md-4 mb-1">
                <p><span><b>Sexo: </b></span><span>{{ $conveniado->sexo == "M" ? 'Masculino' : 'Feminino' }}</span></p>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-5 mb-1">
                <p><span><b>Telefone 1: </b></span><span>{{ $conveniado->tel1 }}</span></p>
            </div>
            <div class="col-md-5 mb-1">
                <p><span><b>Telefone 2: </b></span><span>{{ $conveniado->tel2 }}</span></p>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-8 mb-1">
                <p><span><b>Endereço: </b></span><span>{{ $conveniado->logradouro }}</span></p>
            </div>
            <div class="col-md-2 mb-1">
                <p><span><b>Número: </b></span><span>{{ $conveniado->numero }}</span></p>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-1">
                <p><span><b>Bairro: </b></span><span>{{ $conveniado->bairro }}</span></p>
            </div>
            <div class="col-md-4 mb-1">
                <p><span><b>Cidade: </b></span><span>{{ $conveniado->cidade }}</span></p>
            </div>
            <div class="col-md-3 mb-1">
                <p><span><b>Estado: </b></span><span>{{ $conveniado->estado }}</span></p>
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 mb-6 text-center">
        <b class="text-blue">Consultas</b>
        <table class="table table-striped table-hover colored">
            <thead>
                <tr>
                    <th class="text-center">Credenciado</th>
                    <th class="text-center">Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-left"></td>
                    <td class="text-center"></td>
                </tr>
            </tbody>
        </table>
    </div>
    @if($conveniado->titular_id < 1)
    <div class="col-md-6 mb-6 text-center">
        <b class="text-blue">Dependentes</b>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">Nome</th>
                    <th class="text-center">CPF</th>
                    <th class="text-center">Nascimento</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dependentes as $dependente)
                <tr>
                    <td class="text-left"><a href="/conveniado/ficha/{{ $dependente->id }}" title='Ficha do Conveniado'>{{ $dependente->nome }}</a></td>
                    <td class="text-center">{{ $dependente->cpfcnpj }}</td>
                    <td class="text-center">{{ implode('/', array_reverse(explode('-', $dependente->nascimento))) }}</td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
    @else
    <div class="col-md-6 mb-6 text-center">
        <b class="text-green">Titular</b>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">Nome</th>
                    <th class="text-center">CPF</th>
                    <th class="text-center">Nascimento</th>
                </tr>
            </thead>
            <tbody>
                @forelse($titulars as $titular)
                <tr>
                    <td class="text-left"><a href="/conveniado/ficha/{{ $titular->id }}" title='Ficha do Conveniado'>{{ $titular->nome }}</a></td>
                    <td class="text-center">{{ $titular->cpfcnpj }}</td>
                    <td class="text-center">{{ implode('/', array_reverse(explode('-', $titular->nascimento))) }}</td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
    @endif
</div>
<br /><br /><br />
@stop