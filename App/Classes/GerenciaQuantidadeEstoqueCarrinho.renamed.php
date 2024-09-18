<?php
/*
    --**************************--
    *****  Deprecated Class  *****
    *****  Esta classe foi   *****
    *****   renomeada para   *****
    ***** EstoqueCarrinho.php ****
    --************************--

namespace App\Classes;

use App\Classes\Estoque;

class GerenciaQuantidadeEstoqueCarrinho {

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

    private function verificaEstoque($id, $diferenca){
        if(!$this->estoque->temNoEstoque($id, $diferenca)) {
            echo 'semEstoque';
            die();
        }
    }

    public function gerenciaEstoqueNoCarrinho($id, $quantidade){

        $diferenca = $this->diferenca($id, $quantidade);
        $estoqueAtual = $this->estoqueAtual($id);

        if($_SESSION['carrinho'][$id] > $quantidade) {

            (!$estoqueAtual > $diferenca) ?: $this->estoque->atualizaEstoque($id, ($estoqueAtual + $diferenca)) ;

        } else {

            $this->verificaEstoque($id, $diferenca);

            $this->estoque->atualizaEstoque($id, ($estoqueAtual - $diferenca));

        }

    }

}
*/