<?php

namespace App\Classes;

class Frete {

    private function calculouFrete(){

        if(!isset($_SESSION['frete']) || $_SESSION['frete'] != true) {
            return false;
        }

        return true;

    }

    public function gravarFrete($frete){

        $_SESSION['frete'] = true;
        $_SESSION['valor'] = $frete;

    }

    public function pegarFrete(){

        if($this->calculouFrete()){
            return $_SESSION['valor'];
        }

        return 0;

    }

    public function limparFrete(){

        unset($_SESSION['frete']);
        unset($_SESSION['valor']);

    }

}
