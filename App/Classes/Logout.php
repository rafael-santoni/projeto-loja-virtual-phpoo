<?php

namespace App\Classes;

class Logout {

    public static function logoutUser(){

        unset($_SESSION['id']);
        unset($_SESSION['name']);
        unset($_SESSION['logado']);

    }

}
