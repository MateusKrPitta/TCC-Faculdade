<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {

    protected $connection = 'basesistema';
    protected $table = 'users';
    public $timestamps = true;
    protected $fillable = array('empresa_id', 'perfil_id', 'name', 'email', 'password', 'usuario_id', 'status');

    public function permissaos() {
        return $this->belongsToMany('\App\Permissao');
    }

    public function temPerfil(Perfil $perfil) {
        return $perfil;
    }

    public function temPermissao(Permissao $permissao) {
        return $permissao;
    }

    public static function empresadousuario($id) {
        return Usuario::find($id)['empresa_id'];
    }

    public static function empresa() {
        return Usuario::find(\Illuminate\Support\Facades\Auth::user()->id)['empresa_id'];
    }
    
    public static function id() {
        return \Illuminate\Support\Facades\Auth::user()->id;
    }

    //Relacionamento.
   public function perfil()
    {
        return $this->hasOne('App\Perfil');
    }
    
    //Relacionamento.
    public function credenciados() {
        //    $this->belongsToMany('tabela com relacao com esta model', 'nome da tabela pivot', 'key ref. user em pivot', 'key ref.  credenciado em pivot')
        return $this->belongsToMany('credenciados', 'userscredenciados', 'user_id', 'credenciado_id')->withPivot(['status']);
    }
    
}
