<?php

namespace App\Repositories\Site;

use App\Models\Site\ProdutoModel;
use App\Classes\Carrinho;

class ProdutosCarrinhoRepository {

    private $produtoModel;
    private $carrinho;

    public function __construct(){

        $this->produtoModel = new ProdutoModel;
        $this->carrinho = new Carrinho;

    }

    public function produtosNoCarrinho(){

        $produtos = [];

        foreach ($this->carrinho->produtosCarrinho() as $id=>$qtd) {

            $produtoCarrinho = $this->produtoModel->find('id',$id);
            $valorProduto = ($produtoCarrinho->produto_promocao == 1)
                                ? $produtoCarrinho->produto_valor_promocao
                                : $produtoCarrinho->produto_valor ;

            $produtos[] = [
                'produtos' => $produtoCarrinho,
                'subtotal' => $valorProduto*$qtd,
                'qtd' => $qtd,
                'valor' => $valorProduto
            ];

        }

        return $produtos;

    }

}
