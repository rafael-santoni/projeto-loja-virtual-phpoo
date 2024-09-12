<?php

namespace App\Classes;

class PersistInput {

    public function add($value){

        if(!isset($_SESSION['persist'][$value])) {
            $_SESSION['persist'][$value] = $_POST[$value];
        }

    }

    public function show($value){

        if(isset($_SESSION['persist'][$value])) {
            $persist = $_SESSION['persist'][$value];
        }

        self::removeInput($value);

        return isset($persist) ? $persist : '';

    }

    private static function removeInput($value) {
        unset($_SESSION['persist'][$value]);
    }

    public static function removeInputs(){
        unset($_SESSION['persist']);
    }

}
