<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Post;
use App\Permission;

class AuthServiceProvider extends ServiceProvider
{   
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        //'App\Post' => 'App\Policies\PostPolicy',
    ];
    
    public function boot()
    {
        $this->registerPolicies();
        
        //Recuperando todas as permissões e já trás um objeto junto com as permissões (de todas as funções específicas dessa permissão)
        $p = new Permission;
        $permissions = $p->with('roles')->get();
        //Exemplo do que ser retornado acima
        //view_post => Manager, Editor
        //delete_post => Manager
        //edit_post => Manager


        //Listando todas as permissões
        foreach( $permissions as $permission)
        {
            //permission->name pode ser por exemplo view_post
            Gate::define($permission->name, function(User $user) use ($permission) {
               //Retornando do método hasPermission() e passando pra ele a permissão (passamos o objeto completo) do momento
                return $user->hasPermission($permission);  //Aqui retornará true ou false
            });           
        }

        //Antes de verificar esses gates que foram no foreach acima, ele verificará esse aqui de baixo (before)
        //Lembrando que o $user ali é o usuário logado
        Gate::before(function(User $user, $ability){

            //Verificando se existe a permissão de ADM para esse usuário
            if($user->hasAnyRoles('administrador'))
            {
                return true;
            }

        });
    }
}
