<?php

namespace App\Classes;

use App\Classes\ErrorsValidate;

class RepeatedRegistersValidate {

    public function validate($rules){

        foreach ($rules as $key => $rule) {

            if(substr_count($rule, ':') == 1){

                $data = explode(':', $rule);
                if($this->model($data)->find($key, $_POST[$key])){
                    ErrorsValidate::add($key, 'Já existe um registro cadastrado para esse '.$key);
                }

            }

        }

    }

}
