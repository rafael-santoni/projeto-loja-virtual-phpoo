<?php
/*
    --************************--
    ***** Deprecated Class *****
    --************************--

namespace App\Classes;

use App\Interfaces\InterfacePayment;
use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Classes\Frete;

class Pagseguro implements InterfacePayment {

    private $pagseguroConfig;

    public function __construct(){

        $this->pagseguroConfig = new \PagSeguroPaymentRequest;
        \PagSeguroLibrary::init();

    }

    private function produtosEFrete(){

        $produtosCarrinho = new ProdutosCarrinhoRepository;
        $produtosNoCarrinho = $produtosCarrinho->produtosNoCarrinho();

        array_push($produtosNoCarrinho, Frete::formatFreteToObject());

        return $produtosNoCarrinho;

    }

    private function config($data){

        $this->pagseguroConfig->setSender(
            $data['name'].' '.$data['sobrenome'],
            $data['email'],
            $data['ddd'],
            $data['telefone']
        );

        $this->pagseguroConfig->setReference($data['idReferencia']);
        $this->pagseguroConfig->setShippingAddress(null);
        $this->pagseguroConfig->setCurrency('BRL');

        foreach ($this->produtosEFrete() as $produto) {

            $this->pagseguroConfig->addItem(
                $produto['produtos']->id,
                $produto['produtos']->produto_nome,
                $produto['qtd'],
                $produto['valor']
            );

        }

    }

    public function dataPayment($data){

        $this->config($data);
        return $this;

    }

    public function pay(){

        $credenciais = new \PagSeguroAccountCredentials(
            'xandecar@hotmail.com',
            'FF579CC8863549A783664FDC85657678'
        );

        // return $this->pagseguroConfig->register($credenciais, true);
        return $this->pagseguroConfig->register($credenciais);

    }

}
*/