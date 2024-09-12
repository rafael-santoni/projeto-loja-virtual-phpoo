<?php

namespace App\Classes;

use App\Classes\ErrorsValidate;

class TypesValidation {

    private $errorValidate;

    public function __construct(){
        $this->errorValidate = new ErrorsValidate;
    }

    public function required($field){

        if(empty($_POST[$field])) {
            $message = "O campo {$field} é obrigatório";
            $this->errorValidate->add($field, $message);
        }

    }

    public function email($field){

        if(!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
            $message = "O campo {$field} deve conter um email válido";
            $this->errorValidate->add($field, $message);
        }

    }

    public function phone(){

    }

    public function cep(){

    }

    public function ddd(){

    }

}
