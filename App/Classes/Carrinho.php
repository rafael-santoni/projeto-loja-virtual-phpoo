<?php

namespace App\Classes;

use App\Classes\StatusCarrinho;

class Carrinho {

    public $statusCarrinho;

    public function __construct(){

        $this->statusCarrinho = new StatusCarrinho;
        $this->statusCarrinho->criarCarrinho();

    }

    public function add($id){

        if($this->statusCarrinho->produtoEstaNoCarrinho($id)) {
            $_SESSION['carrinho'][$id] += 1;
        } else {
            $_SESSION['carrinho'][$id] = 1;
        }

    }

    public function produtoCarrinho($id){
        return $_SESSION['carrinho'][$id];
    }

}
