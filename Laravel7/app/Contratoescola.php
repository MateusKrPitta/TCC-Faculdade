<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contratoescola extends Model {

    protected $connection = 'basesistema';
    protected $table = 'contratoescolas'; // Nome da Tabela no banco de dados
    public $timestamps = true;  //Atualiza os campos de ultima atualização e data da gravação
    protected $fillable = array(
        'empresa_id',
        'cliente_id',
        'aluno_id', 
        'datadocontrato',
        'valor',
        'formadepagamento_id',
        'modalidade',
        'anoletivo',
        'autorizaredessociais',
        'titulocontrato1',
        'titulocontrato2',
        'endereco1',
        'endereco2',
        'razaosocial',
        'enderecorazaosocial',
        'cnpj',
        'inscricaomunicipal',
        'valorintegral',
        'valorparcial',
        'valorhoraextra',
        'valorrefeicaoextra',
        'valor19horas',
        'horariointegral',
        'horarioparcial',
        'anexotexto',
        'cidadeforo',
        'cidadecontrato',
        'observacao',
        'status',
        'usuario_id'); //Informações que serão gravadas no banco

}
