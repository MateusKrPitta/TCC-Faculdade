<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Empresa;
use App\Perfil;
use App\Permissao;
use App\Usuario;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        \App\Cliente::class => \App\Policies\ClientePolicy::class,
        \App\Fornecedor::class => \App\Policies\FornecedorPolicy::class,
        \App\Usuario::class => \App\Policies\UsuarioPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();
        
        /*
          $usuario = Usuario::find(\Illuminate\Support\Facades\Auth::user()->id);
          foreach ($usuario->permissaos as $permis) {
          Gate::define($permis->nome, function($user) {
          return 1;
          });
          }
         * 
         */

        /*

          Gate::define('menu-importacao', function($user){
          $id_permissao = Permissao::where('nome', 'menu-cadastrarempresas')->get('id')[0]->id;//Busca o indice 0 do resultado e mostra o atributo id
          return 1;
          });

          Gate::define('menu-configuracoes', function($user){
          $id_permissao = Permissao::where('nome', 'menu-cadastrarempresas')->get('id')[0]->id;//Busca o indice 0 do resultado e mostra o atributo id
          return 1;
          });

          Gate::define('menu-cadastrarempresas', function($user){
          $id_permissao = Permissao::where('nome', 'menu-cadastrarempresas')->get('id')[0]->id;//Busca o indice 0 do resultado e mostra o atributo id
          return 1;
          });
         */
        /*
          //$usuario = Usuario::find(\Illuminate\Support\Facades\Auth::user()->id);
          $u = \Illuminate\Support\Facades\Auth::user();
          //dd($u);
          $usuario = $u->id;

          foreach ($usuario->permissaos as $permis) {
          Gate::define($permis->nome, function($user) {
          return 1;
          });
          }


          /*
          Gate::define('menu-cadastrarusuario', function($user) {
          return 1;
          });


          Gate::define('menu-configuracoes', function($user) {
          return 1;
          });

         */
    }

}
