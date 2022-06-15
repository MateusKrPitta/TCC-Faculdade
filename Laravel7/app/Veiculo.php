<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model {

	protected $connection = 'basesistema';
	protected $table = 'veiculos'; // Nome da Tabela no banco de dados
	public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
	protected $fillable = array('empresa_id', 'nome', 'marcamodelo', 'placa', 'acentos', 'desenho', 'imagem', 'status', 'observacoes', 'usuario_id', 'created_at', 'updated_at', 'renavam', 'chassi', 'motor', 'anofabricacao', 'anomodelo', 'cidade', 'uf', 'antt', 'tara', 'capacidade', 'volume', 'cor_id', 'marca_id', 'especie_id', 'categoria_id', 'combustivel_id', 'carroceria_id', 'rodado_id', 'linha_id', 'propriedade_id', 'tipo_id', 'eixo_id', 'cilindrada', 'valordobem', 'valorcompensado', 'porcentagem', 'franquia', 'quotaparticipacao', 'valorfipe',  'codigofipe', 'cliente_id'); //Informações que serão gravadas no banco

}
