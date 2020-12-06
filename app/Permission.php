<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Role;


class Permission extends Model
{
    //Método que cria o relacionamento e retorna todas as rules que estão vinculadas as permissçoes
    public function roles()
    {
    	return $this->belongsToMany(Role::class);
    }
}
