<?php

namespace App\Classes;

use App\Classes\Password;
use App\Models\Model;
// use App\Interfaces\InterfaceLogin;

class Login {

    private $email;
    private $password;

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPassword($password){
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
