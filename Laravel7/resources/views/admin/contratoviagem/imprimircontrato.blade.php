@extends('adminlte::page')

@section('content_header')

@stop

@section('content')
<h3 class="text-center"  > Contrato de Prestação de Serviço de Viagem </h3>
<b>Contratante</b>
<br />
{{ $contratoviagem[0]->cliente_nome }} portador do CPF {{ $contratoviagem[0]->cliente_cpf }}, 
residente no endereço {{ $contratoviagem[0]->cliente_endereco }}, {{ $contratoviagem[0]->cliente_numero }}, no bairro 
{{ $contratoviagem[0]->cliente_bairro }}, na cidade de {{ $contratoviagem[0]->cliente_cidade }}-{{ $contratoviagem[0]->cliente_estado }}
<br /><br /><b>Contratado</b>
<br />
NIL-TUR TRANSPORTES registrada com o CNPJ 37.210.815/0001-05, localizada na Rua Toshinobu Katayama, 316, no bairro Jardim Caramuru em Dourados-MS.
<br />
<br />
1 - Realizarão a viagem no veículo {{ $contratoviagem[0]->marcamodelo }} com a placa {{ $contratoviagem[0]->placa }} com capacidade para {{ $contratoviagem[0]->acentos }} passageiros.
<br />
2 - Itinerário: {{ $contratoviagem[0]->itinerario }}
<br />
3 - O valor da viagem será de R$ {{number_format($contratoviagem[0]->valor,2,',','.') }}, com destino a {{ $contratoviagem[0]->localdedestino }}
<br />
4 - O embarque para saída será {{implode('/', array_reverse(explode('-', $contratoviagem[0]->datainicio)))}} as {{ $contratoviagem[0]->horainicio }} {{ $contratoviagem[0]->localembarqueinicio }}
<br />
5 - O embarque para retorno será {{implode('/', array_reverse(explode('-', $contratoviagem[0]->dataretorno)))}} as {{ $contratoviagem[0]->horaretorno }} {{ $contratoviagem[0]->localembarqueretorno }}
<br />
6 - Com destino no mesmo local de embarque sem horário definido para chegada.
<br />
7 - No preço da viagem o saldo devedor deverá sofrer reajuste nas mesmas proporções do índice inflacionário divulgado pelo governo.
<br />
8 - O presente contrato poderá ser rescindido por qualquer das partes, cabendo a parte prejudicada, uma indenização pelos prejuízos sofridos, no valor correspondente a 50% do valor do contrato.
<br />
9 - Não será permitido no interior do ônibus: fumar, viajar em pé, lotação superior ao número de lugares ofertados, viajarem sem camisa, viajar com trajes de banho, usar instrumentos musicais, sentar no descanso do braço e consumir bebida alcoólica.
<br />
10 - O contratante responsabiliza-se perante a empresa contratada, por quaisquer danos materiais que algum integrante da excursão causar no veículo, tais como: cortes e riscos nos bancos e na pintura, piso ou poltronas queimadas em virtude do uso de cigarros, cortinas rasgadas, extravio de capas de poltronas, extravio de cortinas, etc. ou qualquer outro dano causado pelos passageiros, e também pela lavagem interna e externa do ônibus, caso algum integrante do grupo sujar o veículo em consequência do uso de batom, creme dental, bebidas ou algo semelhante.
<br />
11- Os guias portarão o contrato, ou pessoa do grupo designada pelo mesmo.
<br />
12 - A empresa contratada não será responsável pelos danos sofridos pelos excursionistas, pelo atraso que se verificar na chegada do destino ou no retorno.
<br />
13 - O contratante entregará à empresa uma relação nominal dos excursionistas, contendo o número e o órgão emissor da cédula de identidade com pelo menos 03 (três) dias de antecedência da viagem.
<br />
14 - Em caso de impossibilidade de continuação da viagem devido a defeito no ônibus, a contratada se responsabilizará pela contratação de um veículo na cidade mais próxima para termino da viagem.
<br /><br />
Dourados-MS, {{implode('/', array_reverse(explode('-', $contratoviagem[0]->datadocontrato)))}} .
<br /><br />

<input class="btn btn-lg btn-warning btn-block no-print" type="button" value="Imprimir" onclick="window.print()"/>

<br /><br />
@stop