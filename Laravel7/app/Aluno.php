<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    //
        protected $connection = 'basesistema';
	protected $table = 'alunos'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	//Informações que serão gravadas no banco
	protected $fillable = array('empresa_id',
		'nome', 
		'sexo',
		'nascimento',
		'cpf',
		'nomepai',
		'numerotelefonepai',
		'nascimentopai',
		'cpfpai',
		'enderecopai',
		'bairropai',
		'cidadepai',
		'estadopai',
		'emailpai',
		'trabalhopai',
		'telefonetrabalhopai',
		'cargopai',
		'horariopai',
		'nomemae',
		'numerotelefonemae',
		'nascimentomae',
		'cpfmae',
		'enderecomae',
		'bairromae',
		'cidademae',
		'estadomae',
		'emailmae',
		'trabalhomae',
		'telefonetrabalhomae',
		'cargomae',
		'horariomae',
		'relacaopais',
		'cuidados',
		'nomeresponsavel',
		'numerotelefoneresponsavel',
		'nascimentoresponsavel',
		'cpfresponsavel',
		'enderecoresponsavel',
		'bairroresponsavel',
		'cidaderesponsavel',
		'estadoresponsavel',
		'emailresponsavel',
		'trabalhoresponsavel',
		'telefonetrabalhoresponsavel',
		'cargoresponsavel',
		'horarioresponsavel',
		'nomeresponsavelfinanceiro',
		'numerotelefoneresponsavelfinanceiro',
		'cpfresponsavelfinanceiro',
		'emailresponsavelfinanceiro',
		'papinhasalgada',
		'papinhadefrutas',
		'suco',
		'outraalimentacao',
                'cartaosus',
		'planodesaude',
		'nomeplanodesaude',
		'medicamentos',
		'nomemedicamentos',
		'alergia',
		'nomealergia',
		'alergiaalimento',
		'nomealergiaalimento',
		'problemasaude',
		'nomeproblemasaude',
		'necessidadesfisicas',
		'nomenecessidadesfisicas',
		'oculos',
		'anemia',
		'diabetes',
		'lactose',
		'refluxo',
		'gluten',
		'tiposanguineo',
		'peso',
		'altura',
		'autorizabuscaraluno',
		'autorizabuscaralunonome',
		'observacoes',
		'status',
		'usuario_id'
		); 
        public function filtro(Array $dados, $linhasNaPagina) {
        return $this->where(function ($query) use ($dados) {
                            if (isset($dados['nome']))
                                $query->where('nome', 'ilike', '%' . $dados['nome'] . '%');
                            if (isset($dados['cpfcnpj']))
                                $query->where('cpf', 'ilike', '%' . $dados['cpf'] . '%');
                        })
                        ->orderBy('nome')->where('empresa_id', Usuario::empresa())->paginate($linhasNaPagina);
    }

}
