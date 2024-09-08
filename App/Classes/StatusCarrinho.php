<?php

namespace App\Classes;

class StatusCarrinho {

    public function carrinhoExiste(){
        return (isset($_SESSION['carrinho'])) ? true : false;
    }

    public function criarCarrinho(){

        if(!$this->carrinhoExiste()) {
            $_SESSION['carrinho'] = [];
        }

    }

    public function produtoEstaNoCarrinho($id){

        if(isset($_SESSION['carrinho'][$id])) {
            return true;
        }

        return false;

    }

    public function carrinho(){
        return $_SESSION['carrinho'];
    }

}
