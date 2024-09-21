<?php

namespace App\Classes;

use App\Models\Site\UserModel;
use App\Classes\Auth;

class Logar {

    public static function logarUser($email, $password){

        $auth = new Auth($email, $password);
        $auth->logar(new UserModel);

    }

}
