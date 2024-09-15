<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Pagseguro;
use App\Classes\Correios;
use App\Classes\Logado;
use App\Classes\Frete;
use App\Classes\IdRandom;
use App\Models\Site\PedidosProdutosModel;
use App\Models\Site\PedidosModel;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class CheckoutController extends BaseController {

    private $produtosCarrinho;
    private $correios;
    private $pedidosProdutos;
    private $pedidos;

    public function __construct(){

        $this->produtosCarrinho = new ProdutosCarrinhoRepository;
        $this->correios = new Correios;
        $this->pedidosProdutos = new PedidosProdutosModel;
        $this->pedidos = new PedidosModel;

    }

    public function index(){

        // pegando os produtos do carrinho
        $produtosCarrinho = $this->produtosCarrinho->produtosNoCarrinho();

        // Vefirica se existe produtos no carrinho
        if(empty($produtosCarrinho)) {
            echo json_encode('empty');
            die();
        }

        // Verifica de o usuário está logado
        $logado = new Logado;
        if(!$logado->logado()) {
            echo json_encode('notLoggedIn');
            die();
        }

        // Verifica se calculou o frete
        $frete = new Frete;
        if($frete->pegarFrete() == 0) {
            echo json_encode('frete');
            die();
        }

        $pedidosCadastrado = false;
        foreach ($produtosCarrinho as $produto) {

            $attributes = [
                $produto['produtos']->id,
                $produto['valor'],
                $produto['qtd'],
                IdRandom::generateId(),
                $_SESSION['id'],
                $produto['subtotal']
            ];

            if($this->pedidosProdutos->create($attributes)){
                $pedidosCadastrado = true;
            }

        }

        $pedidoCadastrado = false;
        if($this->pedidos->create([$_SESSION['id'],date('Y-m-d H:i:s'),$frete->pegarFrete(),2,IdRandom::generateId()])) {
            $pedidoCadastrado = true;
        }

        if($pedidosCadastrado && $pedidoCadastrado) {
            // realizar interação com o PagSeguro
        }

    }

}
