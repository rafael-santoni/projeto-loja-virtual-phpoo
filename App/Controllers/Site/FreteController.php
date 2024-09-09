<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Correios;

class FreteController extends BaseController {

    public function calcular(){
        echo json_encode("Calcular o frete dentro do controller");
    }

}
