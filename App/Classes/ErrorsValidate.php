<?php

namespace App\Classes;

class ErrorsValidate {

    public static function add($field, $message){

        if(!isset($_SESSION['error'][$field])) {
            $_SESSION['error'][$field] = $message;
        }

    }

    public static function show($field){

        if(isset($_SESSION['error'][$field])) {
            $message = $_SESSION['error'][$field];
        }

        unset($_SESSION['error'][$field]);

        return (isset($message)) ? '<span style="color: red;">* '.$message.'</span>' : '';

    }

    public function erroValidacao(){

        if(isset($_SESSION['error'])) {
            return (empty($_SESSION['error'])) ? false : true;
        }

    }

}
