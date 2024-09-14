<?php

namespace App\Classes;

use App\Classes\StatusCarrinho;
use App\Classes\Estoque;

class Carrinho {

    private $statusCarrinho;
    private $estoque;

    public function __construct(){

        $this->statusCarrinho = new StatusCarrinho;
        $this->statusCarrinho->criarCarrinho();
        $this->estoque = new Estoque;

    }

    public function add($id){

        if($this->estoque->estoqueAtual($id) > 1) {

            if($this->statusCarrinho->produtoEstaNoCarrinho($id)) {
                $_SESSION['carrinho'][$id] += 1;
            } else {
                $_SESSION['carrinho'][$id] = 1;
            }
            
        }

    }

    public function produtoCarrinho($id){
        return $_SESSION['carrinho'][$id];
    }

    public function update($id, $qtd){

        if($this->statusCarrinho->produtoEstaNoCarrinho($id)) {
            $_SESSION['carrinho'][$id] = $qtd;
        }

    }

    public function remove($id){

        if($this->statusCarrinho->produtoEstaNoCarrinho($id)) {
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
