<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Carrinho;

class CarrinhoController extends BaseController {

    private $carrinho;

    public function __construct(){
        $this->carrinho = new Carrinho;
    }

    public function add($param){
        $this->carrinho->add($param[0]);
    }

}
