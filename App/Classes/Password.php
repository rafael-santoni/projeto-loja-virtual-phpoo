<?php

namespace App\Classes;

class Password {

    public static function hash($password){

        //  PHP < 7
        // $options =[
        //     'cost' => 11,
        //     'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
        // ];
        // echo password_hash($password, PASSWORD_BCRYPT, $options);

        //  PHP >= 7
        $options =[
            'cost' => 11
        ];

        return password_hash($password, PASSWORD_DEFAULT, $options);

    }

    public function verificarPassword($password, $hash){

        if(password_verify($password, $hash)) {
            return true;
        }

        return false;

    }

}
