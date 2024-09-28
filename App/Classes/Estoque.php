<?php

namespace App\Classes;

use App\Repositories\Site\EstoqueRepository;
use App\Models\Site\EstoqueModel;
use App\Classes\Carrinho;

class Estoque {

    private $estoqueRepository;

    public function __construct(){
        $this->estoqueRepository = new EstoqueRepository;
    }

    public function estoqueAtual($id){
        return $this->estoqueRepository->quantidadeProdutosEstoque($id)->estoque_quantidade;
    }

    public function temNoEstoque($idProduto, $diferenca, $quantidadeDigitada){

        $estoqueAtual = $this->estoqueAtual($idProduto);

        if($quantidadeDigitada < Carrinho::produtoCarrinho($idProduto)) {
            $estoque = $estoqueAtual + $diferenca;
        } else {
            $estoque = $estoqueAtual - $diferenca;
        }

        if($estoque < 0){
            return false;
        }

        return true;

    }

    public function atualizaEstoque($id, $qtd){

        $estoqueModel = new EstoqueModel;
        $estoqueModel->update($id, $qtd);

    }

}
