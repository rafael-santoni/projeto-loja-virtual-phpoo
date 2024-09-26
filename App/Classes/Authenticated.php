<?php

namespace App\Classes;

use App\Models\Site\UserModel;
use App\Classes\User;
use App\Classes\Logado;

class Authenticated {

    public static function user(){

        if(Logado::logado()) {

            $user = new User();
            return$user->user(new UserModel);

        }

        throw new Exception("Você precisa estar logado para pegar os dados do user.");

    }

}
