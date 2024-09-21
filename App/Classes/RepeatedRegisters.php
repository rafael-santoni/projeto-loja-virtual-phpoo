<?php

namespace App\Classes;

use App\Interfaces\InterfaceRepeatedRegisters;

class RepeatedRegisters {

    private $repeatedRegisters;

    public function __construct(InterfaceRepeatedRegisters $repeat){
        $this->repeatedRegisters = $repeat;
    }

    public function validate($rules){
        $this->repeatedRegisters->validate($rules);
    }

}
