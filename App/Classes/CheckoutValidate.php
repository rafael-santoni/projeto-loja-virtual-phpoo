<?php

namespace App\Classes;

use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Traits\ErrorsCheckoutValidate;
use App\Classes\Frete;
use App\Classes\Logado;
use App\Classes\QueuedOperations;

class CheckoutValidate extends QueuedOperations {

    use ErrorsCheckoutValidate;

    private function produtosCarrinho(){

        // Pegando os produtos do carrinho
        $produtosCarrinho = new ProdutosCarrinhoRepository;
        // Vefirica se existe produtos no carrinho
        if(empty($produtosCarrinho->produtosNoCarrinho())) {
            $this->error('empty');
        }

    }

    private function isLoggedIn(){

        // Verifica de o usuário está logado
        $logado = new Logado;
        if(!$logado->logado()) {
            $this->error('notLoggedIn');
        }

    }

    private function freteCalculado(){

        // Verifica se calculou o frete
        $frete = new Frete;
        if($frete->pegarFrete() == 0) {
            $this->error('frete');
        }

    }

    public function handle(){

        $this->isLoggedIn();
        $this->produtosCarrinho();
        $this->freteCalculado();

    }

}
