<?php

namespace App\Classes;

use App\Interfaces\InterfaceRepeatedRegisters;

class RepeatedRegistersSite implements InterfaceRepeatedRegisters {

    CONST SITE_NAMESPACE = "App\\Models\\Site\\";

    public function model($data){

        $model = self::SITE_NAMESPACE.ucfirst($data[1]).'Model';
        return new $model;
        
    }

}
