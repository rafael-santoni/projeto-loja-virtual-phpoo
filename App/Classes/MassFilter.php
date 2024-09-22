<?php

namespace App\Classes;

use App\Classes\Filters;
use App\Classes\Password;

class MassFilter extends Filters {

    private $object = [];

    private function setObject($key, $value){
        $this->object[$key] = $value;
    }

    public function filterInputs(...$fields){

        foreach ($fields as $value) {

            $explode = explode(':', $value);

            $type = isset($explode[1]) ? $explode[1] : 'string';

            $this->setObject($explode[0], $this->filter($explode[0], $type));

        }

    }

    public function get($key){
        return $this->object[$key];
    }

    public function all($passwordEncrypt = null){

        if($passwordEncrypt == true) {
            $this->object['password'] = Password::hash($this->get('password'));
        }

        return $this->object;

    }

}
