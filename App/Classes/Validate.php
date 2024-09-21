<?php

namespace App\Classes;

use App\Interfaces\InterfaceRepeatedRegisters;
use App\Classes\RepeatedRegisters;
use App\Classes\TypesValidation;
use App\Classes\PersistInput;

class Validate {

    private $rules;

    public function __construct($rules){
        $this->rules = $rules;
    }

    private static function callMethodAndValidate($validateMethod, $field){

        PersistInput::add($field);

        if(!is_array($validateMethod)) TypesValidation::$validateMethod($field);

        if(is_array($validateMethod)) {

            foreach ($validateMethod as $method) {
                TypesValidation::$method($field);
            }

        }

    }

    public function repeatedRegisters(InterfaceRepeatedRegisters $repeat){

        $repeatedRegisters =  new RepeatedRegisters($repeat);
        $repeatedRegisters->validate($this->rules);

    }

    // public static function validate($rules){
    public static function validate(){

        // foreach ($rules as $field => $method) {
        foreach ($this->rules as $field => $method) {

            if(substr_count($method, ':') > 0) $method = strstr($method, ':', true);

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
