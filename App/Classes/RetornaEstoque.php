<?php

namespace App\Classes;

use App\Repositories\Site\CarrinhoRepository;
use App\Models\Site\CarrinhoModel;
use App\Classes\Estoque;

class RetornaEstoque {

    private $estoque;

    public function __construct(){
        $this->estoque = new Estoque;
    }

    public function retornaProdutoEstoque($id, $sessao){

        $carrinhoRepository = new CarrinhoRepository;
        $produtoCarrinho = $carrinhoRepository->produtoSessao($id, $sessao);
        $this->estoque->atualizaEstoque(
            $produtoCarrinho->produto,
            ($this->estoque->estoqueAtual($produtoCarrinho->produto) + $produtoCarrinho->quantidade)
        );

    }

    public function retornaEstoque($sessao){

        $carrinhoModel = new CarrinhoModel;
        $produtosCarrinho = $carrinhoModel->find('sessao', $sessao, 'all');
        foreach ($produtosCarrinho as $produto) {

            $this->estoque->atualizaEstoque(
                $produto->produto,
                ($this->estoque->estoqueAtual($produto->produto) + $produto->quantidade)
            );

        }

    }

}
