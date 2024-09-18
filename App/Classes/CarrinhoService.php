<?php

namespace App\Classes;

use App\Classes\Carrinho;
use App\Classes\CarrinhoBanco;

class CarrinhoService {

    private $carrinhoBanco;

    public function __construct(){

        $this->carrinhoBanco = new CarrinhoBanco;

    }

    public function add($id){

        if(!Carrinho::produtoEstaNoCarrinho($id)){

            Carrinho::add($id);
            $this->carrinhoBanco->add($id);

        } else {

            Carrinho::addOneMore($id);
            $this->carrinhoBanco->update($id);

        }

    }

}
