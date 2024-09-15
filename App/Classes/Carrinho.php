<?php

namespace App\Classes;

use App\Classes\StatusCarrinho;
use App\Classes\Estoque;
use App\Models\Site\CarrinhoModel;

class Carrinho {

    private $statusCarrinho;
    private $estoque;
    private $carrinhoModel;

    public function __construct(){

        $this->statusCarrinho = new StatusCarrinho;
        $this->statusCarrinho->criarCarrinho();
        $this->estoque = new Estoque;
        $this->carrinhoModel = new CarrinhoModel;

    }

    public function add($id){

        if($this->estoque->estoqueAtual($id) > 1) {

            if($this->statusCarrinho->produtoEstaNoCarrinho($id)) {

                $_SESSION['carrinho'][$id] += 1;
                $this->carrinhoModel->update($id, $this->produtoCarrinho($id));

            } else {

                $_SESSION['carrinho'][$id] = 1;
                $this->carrinhoModel->add([
                    1 => $id,
                    2 => 1,
                    3 => '123',
                    4 => date('Y-m-d H:i:s'),
                    5 => date('Y-m-d H:i:s', strtotime('+1minute'))
                ]);

            }

            $this->estoque->atualizaEstoque($id, ($this->estoque->estoqueAtual($id) - 1));

        }

    }

    public function produtoCarrinho($id){
        return $_SESSION['carrinho'][$id];
    }

    public function update($id, $qtd){

        if($this->statusCarrinho->produtoEstaNoCarrinho($id)) {

            if(!$this->estoque->temNoEstoque($id, $qtd)) {
                echo 'semEstoque';
                die();
            }

            $estoqueAtual = $this->estoque->estoqueAtual($id);
            $diferenca = abs($_SESSION['carrinho'][$id] - $qtd);
            if($_SESSION['carrinho'][$id] > $qtd) {

                (!$estoqueAtual > $diferenca) ?: $this->estoque->atualizaEstoque($id, ($estoqueAtual + $diferenca)) ;

            } else {
                $this->estoque->atualizaEstoque($id, ($estoqueAtual - $diferenca));
            }

            $_SESSION['carrinho'][$id] = $qtd;
            $this->carrinhoModel->update($id, $qtd);

        }

    }

    public function remove($id){

        if($this->statusCarrinho->produtoEstaNoCarrinho($id)) {
            unset($_SESSION['carrinho'][$id]);
            $this->carrinhoModel->remove($id);
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
