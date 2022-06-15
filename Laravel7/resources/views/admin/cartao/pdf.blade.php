<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cartao Amena</title>
</head>
<body style="width: 100%;">
    <div style="color: white; font-family: helvetica; position: absolute; padding: 0">
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

        <div style="font: 14px; padding-left: 4; width: 270px"><b>{{$cartao->nomenocartao}}</b></div>
        <div style="font: 16px; padding-left: 4; padding-top: 3"><b>{{substr($cartao->numeronocartao, 0, 4) . '  ' . substr($cartao->numeronocartao, 4, 4) . '  ' . substr($cartao->numeronocartao, 8, 4) . '  ' . substr($cartao->numeronocartao, 12, 4)}}</b></div>

        <div >
            <div style="font: 14px; text-align: center; padding-left: 4; width: 130px; height: 10px; display: inline-block; margin: 0"><b>{{implode('/', array_reverse(explode('-', $cartao->nascimento))) }}</b></div>
            <div style="font: 14px; text-align: center; padding-left: 4; width: 130px; height: 10px; display: inline-block; margin: 0"><b>{{implode('/', array_reverse(explode('-', $cartao->datadevalidade))) }}</b></div>
        </div>

        <div>
            <div style="font: 11px; text-align: center; padding-left: 4; width: 130px; height: 20px; display: inline-block; margin: 0">Data de Nascimento</div>
            <div style="font: 11px; text-align: center; padding-left: 4; width: 130px; height: 20px; display: inline-block; margin: 0">Data de Validade</div>
        </div>

        <div style="width: 270px; padding-top: 4;">
            <div style="font: 11px; padding-left: 4;">Titular</div>

        </div>

        <div style="width: 275px">
            <div style="font: 14px; padding-left: 4;"> {{$titular->nome}} </div>
        </div>

    </div>
    <div><img src="{{ public_path('Cartao01.png') }}" width="480" alt="Imagem 1 do Cartão" /></div>
    <div><img src="{{ public_path('Cartao02.png') }}" width="480" alt="Imagem 2 do Cartão" /></div>
</body>