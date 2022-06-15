@extends('adminlte::page')

@section('content_header')

<div class="row col-md-12">
    <div class="col-md-6">
        <form action="/conveniado/imprimelista" method="POST" class="needs-validation" >
            {!! csrf_field() !!}
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="inicio">Início: </label>
                    <input type="date" name="inicio" value="{{ date("Y-m-d", strtotime("-7 day")) }}" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="fim">Fim: </label>
                    <input type="date" name="fim" value="{{ date("Y-m-d") }}" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <br />
                    <button type="submit" class="btn btn-lg btn-default">Filtrar</button>
                </div>

            </div>
        </form>
    </div>
    <div class="col-md-2">
        <a href="/conveniado/exportaXLSX"> <button type="submit" class="btn btn-lg btn-info">Exporta XLS</button> </a>
    </div>
    <div class="col-md-2">
        <a href="/conveniado/exportaPDF"> <button type="submit" class="btn btn-lg btn-danger">Exporta PDF</button> </a>
    </div>
    <div class="col-md-2">
        <form><button type="button" class="btn btn-lg btn-success" onClick="window.print()">Imprimir</button></form>
    </div>
</div>

@stop

@section('content')
<h1 class="text-center">Lista de Conveniados </h1>
<table class="table table-sm table-condensed table-bordered">
    <thead style="font-family:sans-serif; font-size-adjust: 0.4; padding: 0; margin: 0; border: 0">
        <tr>
            <th class="text-center">Nome</th>
            <th class="text-center">Titular</th>
            <th class="text-center">Telefone</th>
            <th class="text-center">Nascimento</th>
            <th class="text-center">Validade</th>
            <th class="text-center">Número do Cartão</th>
            <th class="text-center no-print">Status</th>

        </tr>
    </thead>
    <tbody style="font-family:sans-serif; font-size-adjust: 0.3; padding: 0; margin: 0; border: 0">

        @forelse($conveniados as $conveniado)
        <tr>
            <td class="text-left">{{ $conveniado->nome}}</td>
            <td class="text-left">
                @if ($conveniado->titular_id > 0) 
                @forelse($listaconveniados as $lista1)
                @if($lista1->id == $conveniado->titular_id)
                {{ $lista1->nome }} 
                @endif
                @empty
                @endforelse
                @endif
            </td>
            <td class="text-center">{{ $conveniado->tel1}}</td>
            <td class="text-center">{{ implode('/', array_reverse(explode('-', $conveniado->nascimento))) }}</td>
            <td class="text-center">{{ implode('/', array_reverse(explode('-', $conveniado->datadevalidade)))}}</td>
            <td class="text-center">{{ $conveniado->numeronocartao}}</td>
            <td class="text-center no-print">
                @if ($conveniado->status == "0") 
                <a title='Inativo'>
                    <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
                </a>
                @endif
                @if ($conveniado->status == "1")
                <a title='Ativo'>
                    <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
                </a>
                @endif
                @if ($conveniado->status == "2")
                <a title='Aguardando Contrato'>
                    <span style="color:blue" class="fas fa-file-invoice" aria-hidden="true"></span>
                </a>
                @endif
                @if ($conveniado->status == "3")
                <a title='Aguardando Assinatura'>
                    <span style="color:blueviolet" class="fas fa-marker" aria-hidden="true"></span>
                </a>
                @endif
                @if ($conveniado->status == "4")
                <a title='Aguardando Confirmação de Pagamento'>
                    <span style="color:yellowgreen" class="fas fa-file-invoice-dollar" aria-hidden="true"></span>
                </a>
                @endif
            </td>

        </tr>

        @empty
        @endforelse
    </tbody>
</table>


@stop