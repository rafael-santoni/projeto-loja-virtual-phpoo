<?php

namespace App\Classes;

class TypesValidation {

    public function required($field){

        if($_POST[$field] == '') {
            dump("O campo $field é obrigatório");
        }

    }

    public function email(){

    }

    public function phone(){

    }

    public function cep(){

    }

    public function ddd(){

    }

}
