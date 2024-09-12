<?php

namespace App\Classes;

use App\Classes\TypesValidation;

class Validate {

    private $typeValidation;

    public function __construct(){
        $this->typeValidation = new TypesValidation;
    }

    public function validate($rules){

        foreach ($rules as $field => $method) {

            if(substr_count($method, '|') > 0) {

                // contém o pipe no method
                $explodePipe = explode('|',$method);

                foreach ($explodePipe as $methodPipe) {

                    $this->typeValidation->$methodPipe($field);

                }

            } else {

                // não tem o pipe no method
                $this->typeValidation->$method($field);

            }

        }
    }
}
