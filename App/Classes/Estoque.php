<?php

namespace App\Classes;

use App\Repositories\Site\EstoqueRepository;

class Estoque {

    private $estoqueRepository;

    public function __construct(){
        $this->estoqueRepository = new EstoqueRepository;
    }

    public function estoqueAtual($id){
        return $this->estoqueRepository->quantidadeProdutosEstoque($id)->estoque_quantidade;
    }

    public function temNoEstoque($idProduto, $quantidadeProdutoCarrinho){

        if($this->estoqueAtual($idProduto) < $quantidadeProdutoCarrinho) {
            return false;
        }

        return true;

    }

}
