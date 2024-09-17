<?php

namespace App\Classes;

use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Classes\Frete;
use App\Classes\Logado;

class CheckoutValidate {

    public $erro;

    public function validateCheckout(){

        // pegando os produtos do carrinho
        $produtosCarrinho = new ProdutosCarrinhoRepository;

        // Vefirica se existe produtos no carrinho
        if(empty($produtosCarrinho->produtosNoCarrinho())) {
            // echo json_encode('empty');
            $this->erro = 'empty';
            return false;

        }

        // Verifica de o usuário está logado
        $logado = new Logado;
        if(!$logado->logado()) {
            // echo json_encode('notLoggedIn');
            $this->erro = 'notLoggedIn';
            return false;

        }

        // Verifica se calculou o frete
        $frete = new Frete;
        if($frete->pegarFrete() == 0) {
            // echo json_encode('frete');
            $this->erro = 'frete';
            return false;

        }

        return true;

    }

}
