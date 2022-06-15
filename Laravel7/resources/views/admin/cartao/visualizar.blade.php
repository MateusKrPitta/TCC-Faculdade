@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

<div style="background-color: white">
    <div class="position-absolute pl-3" style="color: white; font-family: helvetica;">
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

        <div class="text-sm"><b>{{$cartao->nomenocartao}}</b></div>
        <div class="text-lg"><b>{{substr($cartao->numeronocartao, 0, 4) . '  ' . substr($cartao->numeronocartao, 4, 4) . '  ' . substr($cartao->numeronocartao, 8, 4) . '  ' . substr($cartao->numeronocartao, 12, 4)}}</b></div>

        <div class="row pt-lg-2" style="width: 270px;">
            <div class="text-center col-6">{{implode('/', array_reverse(explode('-', $cartao->nascimento))) }}</div>
            <div class="text-center col-6">{{implode('/', array_reverse(explode('-', $cartao->datadevalidade))) }}</div>
        </div>
        <div class="row" style="width: 270px; font-size-adjust: 0.4">
            <div class="text-center col-6">Data de Nascimento</div>
            <div class="text-center col-6">Data de Validade</div>
        </div>
        <div class="row text-sm pt-lg-2"  style="font-size-adjust: 0.4">
            <div class="">Titular</div>
        </div>
        <div class="row">
            <div class="text-sm"> {{$titular->nome}} </div>
        </div>
    </div>

</div>

<div><img class="position-static" src="/Cartao01.png" width="480" alt="Imagem 2 do Cartão" /></div>
<div><img class="position-static" src="/Cartao02.png" width="480" alt="Imagem 2 do Cartão" /></div>

@stop