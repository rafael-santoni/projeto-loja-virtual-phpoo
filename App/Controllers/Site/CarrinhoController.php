<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Carrinho;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class CarrinhoController extends BaseController {

    private $carrinho;
    private $produtosCarrinhoRepository;

    public function __construct(){

        $this->carrinho = new Carrinho;
        $this->produtosCarrinhoRepository = new ProdutosCarrinhoRepository;

    }

    public function add($param){
        $this->carrinho->add($param[0]);
    }

    public function get(){
        echo json_encode([
            'numeroProdutosCarrinho' => count($this->carrinho->produtosCarrinho()),
            'valorProdutosCarrinho' => $this->produtosCarrinhoRepository->totalProdutosCarrinho()
        ]);
    }

}
