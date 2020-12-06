<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Gate;


class SiteController extends Controller
{
    
    public function index(Post $post)
    {
        return view('portal.home.index');
    }

    public function update($idPost)
    {
        $post = Post::find($idPost);

        //$this->authorize('update-post', $post);

        if(Gate::denies('updatePost', $post))
        {
            abort(403, 'Não Autorizado');
        }

        return view('post-update', compact('post'));
    }

    public function rolesPermissions()
    {
        $nameUser = auth()->user()->name;
        echo "<h1>".$nameUser."</h1>";
        
        //Recuperando todos os roles do usuário
        foreach(auth()->user()->roles as $role)
        {
             echo "<b>$role->name</b> -> ";

             $permissions = $role->permissions;
            //Recuperando todas as permissões que o usuário tem
            foreach($permissions as $permission)
            {
                echo " $permission->name , ";
            }

            echo "<hr>";

        }
    }
}
