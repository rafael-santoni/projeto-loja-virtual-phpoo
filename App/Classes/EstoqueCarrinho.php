<?php

namespace App\Classes;

use App\Classes\Estoque;
use App\Classes\Carrinho;

class EstoqueCarrinho {

    private $estoque;

    public function __construct(){
        $this->estoque = new Estoque;
    }

    private function diferenca($id, $quantidade){
        return abs($_SESSION['carrinho'][$id] - $quantidade);
    }

    private function estoqueAtual($id){
        return $this->estoque->estoqueAtual($id);
    }

    private function verificaEstoque($id, $diferenca, $quantidadeDigitada){
        if(!$this->estoque->temNoEstoque($id, $diferenca, $quantidadeDigitada)) {
            echo 'semEstoque';
            die();
        }
    }

    private function somaEstoque($id, $diferenca){
        (!$this->estoqueAtual($id) > $diferenca) ?: $this->estoque->atualizaEstoque($id, ($this->estoqueAtual($id) + $diferenca)) ;
    }

    private function diminuiEstoque($id, $diferenca){
        $this->estoque->atualizaEstoque($id, ($this->estoqueAtual($id) - $diferenca));
    }

    public function gerenciaEstoque($id, $quantidadeDigitada){

        $diferenca = $this->diferenca($id, $quantidadeDigitada);

        $this->verificaEstoque($id, $diferenca, $quantidadeDigitada);

        if(Carrinho::produtoCarrinho($id) > $quantidadeDigitada) {
            $this->somaEstoque($id, $diferenca);
        } else {
            $this->diminuiEstoque($id, $diferenca);
        }

    }

}
