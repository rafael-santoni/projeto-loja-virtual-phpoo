<?php

namespace App\Classes;

class Logado {

    public function logado(){

        if(isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
            return true;
        }

        return false;

    }

}
