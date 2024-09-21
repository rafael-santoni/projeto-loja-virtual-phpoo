<?php

namespace App\Classes;

use App\Classes\ErrorsValidate;

class TypesValidation {

    public static function required($field){

        if(empty($_POST[$field])) {
            $message = "O campo {$field} é obrigatório";
            ErrorsValidate::add($field, $message);
        }

    }

    public static function email($field){

        if(!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
            $message = "O campo {$field} deve conter um email válido";
            ErrorsValidate::add($field, $message);
        }

    }

    public static function phone(){

    }

    public static function cep(){

    }

    public static function ddd(){

    }

}
