<?php

namespace App\Classes;

use App\Classes\TypesValidation;
use App\Classes\PersistInput;

class Validate {

    private static function callMethodAndValidate($validateMethod, $field){

        PersistInput::add($field);

        if(!is_array($validateMethod)) TypesValidation::$validateMethod($field);

        if(is_array($validateMethod)) {

            foreach ($validateMethod as $method) {
                TypesValidation::$method($field);
            }

        }

    }

    public function validate($rules){

        foreach ($rules as $field => $method) {

            if(substr_count($method, '|') > 0) {

                // contém o pipe no method
                $explodePipe = explode('|', $method);
                self::callMethodAndValidate($explodePipe, $field);

            } else {

                // não tem o pipe no method
                self::callMethodAndValidate($method, $field);

            }

        }

    }

}
