<?php

namespace App\Classes;

use App\Classes\Password;
use App\Models\Model;

class Auth {

    private $email;
    private $password;

    public function __construct($email, $password){

        $this->email = $email;
        $this->password = $password;

    }

    public function logar(Model $model){

        $userEncontrado = $model->find('email', $this->email);
        if(!$userEncontrado) {
            return false;
        }

        $password = new Password;
        if($password->verificarPassword($this->password, $userEncontrado->password)) {

            $_SESSION['id'] = $userEncontrado->id;
            $_SESSION['name'] = $userEncontrado->name;
            $_SESSION['logado'] = true;

            return true;

        } else {

            return false;

        }

    }

}
