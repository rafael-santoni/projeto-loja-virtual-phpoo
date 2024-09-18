<?php

namespace App\Classes;

use App\Classes\StatusCarrinho;
use App\Classes\Estoque;
use App\Classes\GerenciaQuantidadeEstoqueCarrinho;
// use App\Models\Site\CarrinhoModel;

class Carrinho {

    private $statusCarrinho;
    private $estoque;
    // private $carrinhoModel;

    public function __construct(){

        $this->statusCarrinho = new StatusCarrinho;
        $this->statusCarrinho->criarCarrinho();
        $this->estoque = new Estoque;
        // $this->carrinhoModel = new CarrinhoModel;

    }

    public static function add($id){

        // if($this->estoque->estoqueAtual($id) > 0) {

            // if($this->statusCarrinho->produtoEstaNoCarrinho($id)) {
                $_SESSION['carrinho'][$id] += 1;
            // } else {
            //     $_SESSION['carrinho'][$id] = 1;
            // }

            // $this->estoque->atualizaEstoque($id, ($this->estoque->estoqueAtual($id) - 1));

        // }

    }

    public static function addOneMore($id){
        $_SESSION['carrinho'][$id] += 1;
    }

    public static function produtoCarrinho($id){
        return $_SESSION['carrinho'][$id];
    }

    public function update($id, $qtd){

        if($this->statusCarrinho->produtoEstaNoCarrinho($id)) {

            $gerenciaEstoqueCarrinho = new GerenciaQuantidadeEstoqueCarrinho;
            $gerenciaEstoqueCarrinho->gerenciaEstoqueNoCarrinho($id, $qtd);

            $_SESSION['carrinho'][$id] = $qtd;
            // $this->carrinhoModel->update($id, $qtd, IdRandom::generateId());

        }

    }

    public function remove($id){

        if($this->statusCarrinho->produtoEstaNoCarrinho($id)) {

            // $this->carrinhoModel->remove($id, IdRandom::generateId());
            $this->estoque->atualizaEstoque($id, ($this->estoque->estoqueAtual($id) + $this->produtoCarrinho($id)));
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
