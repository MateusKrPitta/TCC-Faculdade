@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

<table class="table table-bordered">
    <thead>
        
    </thead>
    <tbody>
        <tr>
            <td class="text-center" colspan="12">
                <h2>PROPOSTA DE ADESÃO</h2>
                AMENA GESTÃO DE BENEFÍCIOS LTDA. CNPJ 38.614.358/0001-87
            </td>
        </tr>
        <tr>
            <td class="text-center" colspan="4">Tipo de Proposta:</td>
            <td class="text-center" colspan="4">Inicial</td>
            <td class="text-center" colspan="4">Atualização Cadastral</td>
        </tr>
<!-- Produto -->
        <tr class="table-active">
            <td class="text-left" colspan="12">Produto</td>
        </tr>
        <tr>
            <td class="text-left" colspan="12">Produto Selecionado: {{ $contratoconvenio[0]->plano_nome }}</td>
        </tr>
        <tr>
            <td class="text-left" colspan="12">Valor: R$ {{ number_format($contratoconvenio[0]->plano_valor,2,',','.') }}</td>
        </tr>
        <tr>
            <td class="text-left" colspan="12">Forma de Pagamento: {{ $contratoconvenio[0]->formadepagamento_parcela == 1 ? 'A Vista' : 'Parcelado em '.$contratoconvenio[0]->formadepagamento_parcela.'X'}}</td>
        </tr>
        <tr>
            <td class="text-left" colspan="12">Meio de Pagamento: {{ $contratoconvenio[0]->formadepagamento_nome }}</td>
        </tr>
        <tr>
            <td class="text-left" colspan="12">Observações: <br />{{ $contratoconvenio[0]->conveniado_observacao }}</td>
        </tr>
<!-- Titular -->
        <tr class="table-active">
            <td class="text-left" colspan="12">Titular</td>
        </tr>
        <tr>
            <td class="text-left" colspan="12">Nome: {{ $contratoconvenio[0]->conveniado_nome }}</td>
        </tr>
        <tr>
            <td class="text-left" colspan="3">CPF: {{ $contratoconvenio[0]->conveniado_cpf }}</td>
            <td class="text-left" colspan="3">RG: {{ $contratoconvenio[0]->conveniado_rg }}</td>
            <td class="text-left" colspan="2">Sexo: {{ $contratoconvenio[0]->conveniado_sexo }}</td>
            <td class="text-left" colspan="3">Data de Nascimento: {{ implode('/', array_reverse(explode('-', $contratoconvenio[0]->conveniado_nascimento)))}}</td>
            <td class="text-left" colspan="1">Idade: {{ \Carbon\Carbon::parse($contratoconvenio[0]->conveniado_nascimento)->diff(\Carbon\Carbon::now())->format('%y') }}</td>
        </tr>
        <tr>
            <td class="text-left" colspan="8">Nome da Mãe do Titular:</td>
            <td class="text-left" colspan="4">Quantidade de Dependentes:</td>
        </tr>

<!-- Endereço Residencial -->
        <tr class="table-active">
            <td class="text-left" colspan="12">Endereço Residencial</td>
        </tr>
        <tr>
            <td class="text-left" colspan="4">CEP: {{ $contratoconvenio[0]->conveniado_cep }}</td>
            <td class="text-left" colspan="8">Endereço Residencial: {{ $contratoconvenio[0]->conveniado_endereco }}</td>
        </tr>
        <tr>
            <td class="text-left" colspan="3">Número: {{ $contratoconvenio[0]->conveniado_numero }}</td>
            <td class="text-left" colspan="5">Complemento: {{ $contratoconvenio[0]->conveniado_bairro }}</td>
            <td class="text-left" colspan="4">Bairro: {{ $contratoconvenio[0]->conveniado_bairro }}</td>
        </tr>
        <tr>
            <td class="text-left" colspan="8">Cidade: {{ $contratoconvenio[0]->conveniado_cidade }}</td>
            <td class="text-left" colspan="1">UF: {{ $contratoconvenio[0]->conveniado_estado }}</td>
            <td class="text-left" colspan="3">Celular: {{ $contratoconvenio[0]->conveniado_tel1 }}</td>
        </tr>
        <tr>
            <td class="text-left" colspan="4">Telefone: {{ $contratoconvenio[0]->conveniado_tel1 }}</td>
            <td class="text-left" colspan="4">Telefone para recados: {{ $contratoconvenio[0]->conveniado_tel1 }}</td>
            <td class="text-left" colspan="4">E-Mail: {{ $contratoconvenio[0]->conveniado_email }}</td>
        </tr>

<!-- Dados dos Dependentes -->
@forelse($dependentes as $dependente)
        <tr class="table-active">
            <td class="text-left" colspan="12">Dados dos Dependentes</td>
        </tr>
        <tr>
            <td class="text-left" colspan="8">Nome do Dependente: {{ $dependente->nome }}</td>
            <td class="text-left" colspan="4">Telefone: {{ $dependente->conveniado_tel1 }}</td>
        </tr>
        <tr>
            <td class="text-left" colspan="2">CPF: {{ $dependente->cpfcnpj }}</td>
            <td class="text-left" colspan="2">RG: {{ $dependente->rgie }}</td>
            <td class="text-left" colspan="1">Sexo: {{ $dependente->sexo }}</td>
            <td class="text-left" colspan="2">Estado Civil: {{ $dependente->estadocivil_nome }}</td>
            <td class="text-left" colspan="2">Grau de Parentesco: {{ $dependente->parentesco_nome }}</td>
            <td class="text-left" colspan="2">Data de Nascimento: {{ implode('/', array_reverse(explode('-', $dependente->nascimento)))}}</td>
            <td class="text-left" colspan="1">Idade: {{ \Carbon\Carbon::parse($dependente->nascimento)->diff(\Carbon\Carbon::now())->format('%y') }}</td>
        </tr>
        <tr>
            <td class="text-left" colspan="12">Observações:<br />{{ $dependente->observacao }}</td>
        </tr>
@empty
@endforelse
<!-- Principais Condições de Adesão -->
        <tr class="table-active">
            <td class="text-left" colspan="12">
                Ao preencher e assinar esta Proposta de Adesão declaro: 1. Que recebi todas as informações sobre os meus direitos e obrigações referente ao cartão de descontos contrado; 2. Que optei pelos produtos adquiridos ciente dos benefícios oferecidos, dependentes que poderei cadastrar e requisitos para usufruir das vantagens do Cartão Amena; 3. Que estou ciente de que o Cartão Amena não é um plano de saúde; 4. Que a vigência do contrato é de 1 (um) ano, sem renovação; 5. Que, para todos os fins e efeitos, as informações por mim prestadas são verdadeiras e completas, sem omissão de quaisquer circunstâncias que possam influir na minha aceitação e de meus dependentes; 6. Que a  presente  Proposta de Adesão é  parte  integrante  do  contrato,  o  qual  foi  recebido, integralmente lido, entendido e aceito por mim, sem quaisquer restrições ao seu conteúdo, o que confirmo preenchendo e assinando.
            </td>
        </tr>
        <tr>
            <td class="text-left" colspan="6">Vendedor: {{ $vendedor->name }}</td>
            <td class="text-left" colspan="6">CPF do Vendedor: </td>
        </tr>
        <tr>
            <td class="text-left" colspan="6">Plataforma: </td>
            <td class="text-left" colspan="6">Fone da Plataforma: </td>
        </tr>
        <tr>
            <td class="text-left" colspan="6">Administrativo Amena: {{ $administrativo->name }}</td>
            <td class="text-left" colspan="6">Local e Data: Nova Andradina-MS, {{implode('/', array_reverse(explode('-', $contratoconvenio[0]->datadocontrato)))}} .</td>
        </tr>
        <tr class="table-active">
            <td class="text-left" colspan="12">Assinaturas</td>
        </tr>
        <tr height="100" class="">
            <td class="text-center align-bottom" colspan="6">Administrativo Amena </td>
            <td class="text-center align-bottom" colspan="6">Titular ou Representante Legal</td>
        </tr>

        </tr>
        <tr class="table-active">
            <td class="text-left" colspan="2">Produto</td>
            <td class="text-left" colspan="10">Descrição</td>
        </tr>
        <tr>
            <td class="text-left" colspan="2">Amena Básico</td>
            <td class="text-left" colspan="10">Modalidade para até duas pessoas do núcleo familiar (titular + cônjuge ou filho ou irmão). Inclui todos os benefícios e descontos oferecidos pelo Cartão Amena.</td>
        </tr>
        <tr>
            <td class="text-left" colspan="2">Amena Família Essencial</td>
            <td class="text-left" colspan="10">Modalidade para família de até 4 pessoas (titular + até 3 dependentes, que poderão ser o cônjuge e/ou filhos de até 21 anos* na data da contratação). Inclui todos os benefícios e descontos oferecidos pelo Cartão Amena.</td>
        </tr>
        <tr>
            <td class="text-left" colspan="2">Amena Família Plus</td>
            <td class="text-left" colspan="10">Modalidade para família de até 10 membros (titular + o limite de 9 dependentes, que poderão ser o cônjuge e/ou filhos de até 21 anos* na data da contratação). Nesta modalidade pode-se incluir até 2 netos, desde que filhos dos dependentes. Inclui todos os benefícios e descontos oferecidos pelo Cartão Amena.</td>
        </tr>
        <tr>
            <td class="text-left" colspan="2">Amena Sênior</td>
            <td class="text-left" colspan="10">Modalidade que concede desconto especial para a aquisição de produto agregado para pais e/ou sogros do titular, limitado a duas pessoas por produto adicional. Não é vendido isoladamente, apenas vinculado a outro produto. Inclui todos os benefícios e descontos oferecidos pelo Cartão Amena.</td>
        </tr>

        <tr class="">
            <td class="text-left" colspan="12">* Excepcionalmente, filhos de até 24 anos que estejam cursando universidade, mediante comprovação de matrícula.</td>
        </tr>
        <tr class="table-active">
            <td class="text-left" colspan="12">IMPORTANTE: CARTÃO DE DESCONTOS NÃO É UM PLANO DE SAÚDE, NÃO SE RESPONSABILIZANDO PELOS SERVIÇOS OFERECIDOS PELOS CREDENCIADOS AOS CLIENTES, NEM PELO PAGAMENTO DAS DESPESAS, QUE DEVERÃO SER PAGAS PELO CLIENTE DIRETAMENTE AO PRESTADOR DO SERVIÇO.</td>
        </tr>


    </tbody>
</table>
<br /><br /><br /><br />
<input class="btn btn-lg btn-warning btn-block no-print" type="button" value="Imprimir" onclick="window.print()"/>
<br /><br /><br /><br />
@stop