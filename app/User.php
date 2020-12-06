<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Permission;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Método que retorna todas as funções que esse usuário tem
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    //Esse método serve para verificar se tem a permissão (ele recebe um objeto de permission como parâmetro)
    public function hasPermission(Permission $permission)
    {
       //Recuperando as funções (roles) que estão atribuídas a essa permissão (que vem como parâmetro)
       return $this->hasAnyRoles($permission->roles);
       //Acima, em $permission->roles, podemos ter, por exemplo das roles Manager e Editor
       
    }

    //Verificando se o usuário logado tem essa permissão (se tem, retorna true e deixa o cara passar. Se não, bloqueia o acesso)
    public function hasAnyRoles($roles)
    {
        //Nesse método, verificaremos, por exemplo, se o usuário Carlos possui as roles 'Manager' ou 'Editor'
       
        //Verificando se veio mais de uma roles
        if(is_array($roles) || is_object($roles))
        {
            //Verifica se o usuário possuir essa regra (manager, administrador, etc...) específica, ele verificará a quantidade de vínculos e, se achar, retorna true. Se não houver vínculos, retorna false.
            return !! $roles->intersect($this->roles)->count();
        }

        //Retornando todas as funções que o usuário tem
        return $this->roles->contains('name', $roles); 
    }

}
