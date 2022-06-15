@extends('adminlte::page')

@section('content_header')

@stop

@section('content')
<h3 class="text-center"><b>{{ $configuracao->titulocontrato1 }}</b></h3>
<h3 class="text-center"><b>{{ $configuracao->titulocontrato2 }}</b></h3>
<p>
    {{ $configuracao->endereco1 }}
    <br />
    {{ $configuracao->endereco2 }}
</p>
<h5><b>CONTRATO DE PRESTAÇÃO DE SERVIÇOS EDUCACIONAIS</b></h4>
<br />
Nome do (a) Aluno (a): <b>{{ $contratoescola->nome }}</b>
<br />
DATA DE NASCIMENTO: <b>{{ date('d/m/Y', strtotime($contratoescola->nascimento)) }}</b>, IDADE <b>{{ date('Y')-date('Y', strtotime($contratoescola->nascimento)) }} ANOS</b>, CPF: <b>{{ $contratoescola->cpf }}</b>
<br />
Cartão do SUS nº <b>{{ $contratoescola->cartaosus }}</b>
<br />
Possui Plano de Saúde? <b>{{ $contratoescola->planodesaude == 'S' ? 'Sim. '.$contratoescola->nomeplanodesaude : 'Não.' }}</b>
<br />
Possui alguma alergia a alimentos? <b>{{ $contratoescola->alergia == 'S' ? 'Sim. '.$contratoescola->nomealergia : 'Não.' }}</b>
<br />
Possui alguma alergia a Medicamentos? <b>{{ $contratoescola->alergiaalimento == 'S' ? 'Sim. '.$contratoescola->nomealergiaalimento : 'Não.' }}</b>
<br />
Faz Uso de Algum Medicamento? <b>{{ $contratoescola->medicamentos == 'S' ? 'Sim. '.$contratoescola->nomemedicamentos : 'Não.' }}</b>
<br />
Possui Alguma Necessidade Especial? <b>{{ $contratoescola->necessidadesfisicas == 'S' ? 'Sim. '.$contratoescola->nomenecessidadesfisicas : 'Não.' }}</b>
<br />
Autorizo o Uso de Imagem do Aluno Matriculado Fotos e Vídeos nas Redes Sociais e para Propaganda do Espaço pedagógico? <b>{{ $contratoescola->autorizaredessociais == 'S' ? 'Sim.' : 'Não.' }}</b>
<br />
Autoriza alguém buscar o aluno? <b>{{ $contratoescola->autorizabuscaraluno == 'S' ? 'Sim. '.$contratoescola->autorizabuscaralunonome : 'Não.' }}</b>
<br />
Modalidade CONTRATADA: <b>{{ $contratoescola->modalidade }}</b>
<br />
Responsável Financeiro: <b>{{ $contratoescola->nomeresponsavelfinanceiro }}</b> - CPF: {{ $contratoescola->cpfresponsavelfinanceiro }} - Telefone: {{ $contratoescola->numerotelefoneresponsavelfinanceiro }}
<br />
1) Nome da Mãe ou Responsável: {{ $contratoescola->nomemae.' - CPF: '.$contratoescola->cpfmae.' - Endereço: '.$contratoescola->enderecomae.' - Bairro: '.$contratoescola->bairromae.' - Cidade: '.$contratoescola->cidademae.'-'.$contratoescola->estadomae.' - Telefone: '.$contratoescola->numerotelefonemae.' '.$contratoescola->telefonetrabalhomae.' - e-mail: '.$contratoescola->emailmae }}
<br />
2) Nome do Pai ou Responsável: {{ $contratoescola->nomepai.' - CPF: '.$contratoescola->cpfpai.' - Endereço: '.$contratoescola->enderecopai.' - Bairro: '.$contratoescola->bairropai.' - Cidade: '.$contratoescola->cidadepai.'-'.$contratoescola->estadopai.' - Telefone: '.$contratoescola->numerotelefonepai.' '.$contratoescola->telefonetrabalhopai.' - e-mail: '.$contratoescola->emailpai }}
<br />
Pelo presente contrato particular, que fazem entre si, {{ $contratoescola->razaosocial }}, pessoa jurídica de direito privado, com sede na {{ $contratoescola->enderecorazaosocial }}, Inscrita no CNPJ sob o nº {{ $contratoescola->cnpj }}, com Inscrição Municipal nº {{ $contratoescola->inscricaomunicipal }}, daqui por diante denominada simplesmente CONTRATADA, e do outro lado às partes acima qualificadas, doravante denominadas simplesmente CONTRATANTES, têm, entre si, como justas e contratadas as seguintes cláusulas e condições constantes no presente Contrato de Prestação de Serviços Educacionais por adesão:
<br />
1. OBJETO - O objeto do presente contrato é a prestação de serviços educacionais pela CONTRATADA, correspondente a educação infantil, período e turno requerido pelos CONTRATANTES, para benefício do(a) menor que representam, para o ano letivo de {{ $contratoescola->anoletivo }}.
<br />
2. RESPONSABILIDADE TÉCNICA E PEDAGÓGICA - É de inteira e exclusiva responsabilidade da CONTRATADA a orientação técnica e pedagógica dos serviços prestados, visando sempre os objetivos educacionais previstos no seu Projeto Pedagógico, que os CONTRATANTES declaram ter conhecimento e respeitá-lo, bem como as demais obrigações constantes nas disposições legais aplicáveis à espécie.
<br />
2.1. A CONTRATADA organizará as turmas de acordo com critérios que visem a melhor composição do grupo de crianças, podendo até mesmo, durante o curso do ano letivo promover a mudança de turma do aluno se assim achar conveniente, visando, sempre o melhor interesse de todos os seus alunos.
<br />
3. VALORES, FORMA DE PAGAMENTO e PENALIDADES - Ao matricular-se, os CONTRATANTES se comprometem a pagar a correspondente anuidade, que passa a fazer parte integrante do presente contrato.
<br />
3.1. O pagamento da anuidade deverá ser efetivado de forma antecipada, em 12 (doze) parcelas mensais e consecutivas, até o 5º (quinto) dia de cada mês.
<br />
3.2. Os CONTRATANTES que matricularem seu(s) filho(s) no decorrer do ano letivo, deverão pagar no ato da matrícula a mensalidade correspondente ao mês de ingresso. Caso a criança não possa iniciar suas atividades escolares na data indicada na ficha de matrícula, os CONTRATANTES não farão jus a nenhum tipo de redução ou compensação de valores.
<br />
3.3. A quitação relativa a pagamentos em cheque ocorrerá, apenas, com a respectiva compensação bancária.
<br />
3.4. O não cumprimento dos valores mencionados na Cláusula 3ª, acarretará a cobrança de multa no percentual de 2% (dois por cento) e juros de mora no percentual de 1% (um por cento) ao mês, atualização monetária, bem como o pagamento das despesas efetivadas com eventual cobrança judicial ou extrajudicial do débito, inclusive honorários advocatícios, sem prejuízo da recusa justificada da renovação da matrícula em períodos seguintes, enquanto persistir o débito.
<br />
3.5. Passados 30 (trinta) dias da inadimplência a CONTRATADA poderá adotar as medidas legais pertinentes, com a finalidade de satisfazer o seu crédito.
<br />
3.6. A CONTRATADA poderá conceder descontos, a seu critério, não caracterizando tais descontos redução definitiva do valor do preço, sendo certo que, nos casos em que os CONTRATANTES estejam em débito, perderão de imediato o direito aos descontos eventualmente concedidos, incluindo-se o direito à bolsa-estudo.
<br />
3.7. O não recebimento do carnê ou boleto bancário, não exime os CONTRATANTES de quitar a prestação até a data do vencimento estabelecido no item 3.1, desta cláusula;
<br />
4. CORREÇÃO DE VALORES - O preço da anuidade será corrigido anualmente, conforme planilha de custos, ou quando expressamente permitido por lei, a fim de preservar o equilíbrio contratual, caso qualquer mudança legislativa ou normativa altere a equação econômico-financeira do presente instrumento.
<br />
5. RESTITUIÇÃO DE VALORES - Em caso de impossibilidade de se instalar alguma turma ou classe ofertada, em razão da falta de número mínimo de alunos matriculados, poderão os CONTRATANTES optar pela devolução integral de valores pagos antecipadamente, o que será feito no prazo de até 20 (vinte) dias úteis.
<br />
5.1. Verificada tal hipótese, de número insuficiente de alunos para se constituir uma turma ou classe, a CONTRATADA não poderá ser responsabilizado por eventuais perdas e danos em favor dos CONTRATANTES, por se tratar de fato de terceiro, alheio a sua vontade.
<br />
6. HOMOLOGAÇÃO DA MATRÍCULA - Para a homologação da matrícula os CONTRATANTES devem lançar suas assinaturas no presente instrumento.
<br />
6.1. Nos casos em que os CONTRATANTES tenham obtido algum parcelamento de débito anterior, para ingressar com nova matrícula, esta permanece condicionada até que haja a respectiva quitação.
<br />
6.2. A CONTRATANTES autoriza no ato da matrícula a CONTRATADA a usar o direito de imagem do aluno  em rede sociais para divulgação do Espaço Pedagógico.
<br />
6.3. No caso de Matrícula no Período Integral a criança receberá Café da Manhã, Almoço e Café da Tarde, sendo que o cardápios fica por conta da CONTRATADA não tendo custos para a CONTRATANTE.
<br />
6.4. No caso de Matrícula no Período Matutino a criança receberá Café da Manhã, sendo que o cardápios fica por conta da CONTRATADA não tendo custos para a CONTRATANTE.
<br />
6.5. No caso de Matrícula no Período Vespertino a criança receberá Café da Tarde, sendo que o cardápios fica por conta da CONTRATADA não tendo custos para a CONTRATANTE.
<br />
6.6. A contratante não concordando com o cardápio poderá encaminhar juntos com os materiais do aluno sua refeição, sem direito a descontos ou redução da mensalidade.
<br />
6.7. Nesse ato de Matrícula também autorizo {{ $contratoescola->autorizabuscaralunonome }}, a retirar meu filho na impossibilidade dos Pais que será comunicado em tempo hábil para o responsável do Espaço Pedagógico organizar a saída.
<br />
6.8. Nesse ato também declaro que recebi uma via e concordo com o Protocolo de Biossegurança do Espaço Pedagógico.
<br />
7. RESCISÃO – A rescisão do presente contrato deverá ser feita por escrito, com antecedência mínima de 30 (trinta) dias. Caso contrário, serão devidos os dias até o término desse período.
<br />
7.1. Será cobrada, em razão da rescisão antecipada após o início das aulas, multa rescisória no valor de uma mensalidade, considerando-se, para efeito de cálculo, o valor referente ao turno em que o aluno(a) teve a maior frequência durante o ano letivo.
<br />
7.2. Caso a rescisão seja requerida antes do início das aulas, o valor até então pago será devolvido descontando-se apenas 10% (dez por cento) a título de multa, considerando as despesas administrativas incorridas.
<br />
8. SERVIÇOS OPCIONAIS - Se no curso do período contratual a CONTRATATADA disponibilizar serviço que não esteja inserido em sua grade, este poderá ser contratado em separado, mediante solicitação à administração e instrumento próprio, que será cobrado à parte, na medida e na proporção em que seja prestado. Estão sujeitos a valores próprios, não incluídos na anuidade, por se considerarem opcionais ou de uso facultativo, serviços especiais, como inglês, capoeira, natação, balé, passeios, festas extraclasse, livros, agendas e uniformes.
<br />
9. REENQUADRAMENTO DE HORÁRIO - Os CONTRATANTES poderão solicitar à CONTRATADA o reenquadramento do aluno em novo horário, sendo certo que a alteração só será efetivada à partir do mês seguinte ao da solicitação.
<br />
10. HORAS EXTRAS – As crianças de horário parcial, poderão, em caso de necessidade dos pais, permanecer na escola. O tempo excedente ao contratado, para a entrada ou para saída será anotado e cobrado no boleto do mês subsequente. Não haverá compensação de horário, ou seja, a criança que chegar mais tarde não terá o direito de permanecer além do horário contratado sem pagar hora extra. As crianças que permanecerem após às 19 (dezenove) horas pagarão uma taxa a cada quarto de hora que se iniciar, conforme ANEXO 1.
<br />
11. MATERIAL ESCOLAR - A CONTRATADA se responsabiliza pela aquisição do material escolar de uso comum.
<br />
11.1. Os CONTRATANTES são responsáveis pela aquisição de todo o material escolar individual e produtos de Higiene Pessoal individual, conforme exigência do CONTRATADA.
<br />
12. INTERRUPÇÃO DE FREQUÊNCIA - Nos casos em que o menor não puder frequentar as aulas por um ou mais dias, em função de problemas pessoais, viagens, doença e demais motivos alheios à vontade do CONTRATADA, não haverá redução ou compensação de valores.
<br />
13. RECESSO ANUAL - A CONTRATADA poderá, conforme critérios a serem estabelecidos, optar por realizar um recesso anual de no máximo 30 (trinta) dias, com a finalidade de promover obras de melhoria e manutenção de suas instalações, no caso de recesso irá gerar direito aos CONTRATANTES de redução do valor contratado no período do recesso.
<br />
14. PROBLEMAS DE SAÚDE - O(A) aluno(a) que, no curso do período contratual, apresentar problemas de saúde que requeiram atenção médica, não deverá frequentar as aulas, mas sim, ser encaminhado ao seu médico particular, só devendo retornar a frequentar às aulas após liberação médica.
<br />
15. NECESSIDADES ESPECIAIS - Considerando a importância da inclusão das crianças com necessidades educacionais especiais, no âmbito das instalações da CONTRATADA, fica desde já estabelecido o seguinte:
<br />
15.1. É obrigação dos CONTRATANTES submeter regularmente o aluno com necessidades educacionais especiais a terapias alternativas especializadas, conforme a necessidade apresentada, a fim de auxiliar a CONTRATADA no desenvolvimento educacional do aluno.
<br />
15.2. A CONTRATANTE deverá observar o limite máximo indicado pela legislação em vigor, para a matrícula de alunos com necessidades especiais.
<br />
15.3. A inobservância dos termos e condições dessa cláusula caracterizará infração, passível de rescisão contratual, sem o prejuízo da apuração de perdas e danos.
<br />
16. OBJETOS DE VALOR – Constitui falta grave, passível de rescisão contratual, nos termos da cláusula 7ª, a permissão, por parte do(s) responsável(is) pelo(s) aluno(s) de portar objetos de valor (eletrônicos, relógios, joias, dentre outros), que não sejam autorizados e necessários às atividades pedagógicas, nas instalações (salas de aula, banheiros, pátio de recreação, refeitórios e etc.), não sendo uma escola lugar adequado para se trazer ou portar objetos de valor.
<br />
17. DA RESPONSABILIDADE - Os CONTRATANTES poderão responder civil e/ou criminalmente por eventuais danos que causarem à CONTRATADA, oriundos de boatos e comentários infundados que denigram sua imagem institucional perante terceiros.
<br />
18. NOVAÇÃO - A tolerância ou o não exercício, pela CONTRATADA, de quaisquer direitos a ele assegurados neste contrato ou na lei em geral não importará em novação ou renúncia a qualquer desses direitos, podendo exercitá-los a qualquer tempo.
<br />
19. NOTIFICAÇÕES EXTRAJUDICIAIS - Os CONTRATANTES se comprometem, caso haja divergência em relação há algum fato ou serviço, antes de buscar as vias judiciais, notificar por escrito a CONTRATADA, de quaisquer problemas havidos no curso do presente contrato, a fim de que a mesma possa analisar a questão e adotar providência, caso entenda cabível.
<br /><br />
<b>Anexo 1 </b>
<br />
Anuidades - Ano {{ $contratoescola->anoletivo }}
<br /><br />
<b>Valores</b>
<br />
{{ $contratoescola->valorintegral }}
<br />
{{ $contratoescola->valorparcial }}
<br /><br />
<b>Horas extras</b>
<br />
1 Hora extra = R$ {{ $contratoescola->valorhoraextra }}
<br />
1 Refeição extra = R$ {{ $contratoescola->valorrefeicaoextra }}
<br />
Após às 19 horas, será cobrada uma taxa de {{ $contratoescola->valor19horas }}
<br /><br />
<b>Horário de Funcionamento</b>
<br />
De Segunda à Sexta 
<br />
Integral: {{ $contratoescola->horariointegral }}
<br />
Parcial: {{ $contratoescola->horarioparcial }}
<br /><br />
{{ $contratoescola->anexotexto }}
<br />
As partes elegem o Foro da Comarca de {{ $contratoescola->cidadeforo }}, como o único competente para dirimir eventuais questões resultantes da interpretação ou execução do presente contrato.
<br /><br />
Nova Andradina – MS, {{ $contratoescola->datadocontrato }}.
<br /><br /><br /><br />
<div class="col-12 row">
    <div class="col-6">
        <hr />
        {{ $contratoescola->nomeresponsavelfinanceiro }}
        <br />
        CPF: {{ $contratoescola->cpfresponsavelfinanceiro }}
        <br />
        RESPONSAVEL FINANCEIRO
        <br />
        
    </div>
    <div class="col-6">
        <hr />
        {{ $contratoescola->razaosocial }}
    </div>
</div>
<br /><br />

<input class="btn btn-lg btn-warning btn-block no-print" type="button" value="Imprimir" onclick="window.print()"/>

<br /><br />
@stop