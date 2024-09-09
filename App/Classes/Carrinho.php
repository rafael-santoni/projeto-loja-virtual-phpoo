<?php

namespace App\Classes;

use App\Classes\StatusCarrinho;

class Carrinho {

    private $statusCarrinho;

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

    public function update($id, $qtd){

        if($this->statusCarrinho->produtoEstaNoCarrinho()) {
            $_SESSION['carrinho'][$id] = $qtd;
        }

    }

    public function remove($id){

        if($this->statusCarrinho->produtoEstaNoCarrinho()) {
            unset($_SESSION['carrinho'][$id]);
        }

    }

    public function clear(){

        if($this->statusCarrinho->carrinhoExiste()) {
            unset($_SESSION['carrinho']);
        }

    }

    public function produtosCarrinho(){

        if($this->statusCarrinho->carrinhoExiste()) {
            return $this->statusCarrinho->carrinho();
        }

    }

}
