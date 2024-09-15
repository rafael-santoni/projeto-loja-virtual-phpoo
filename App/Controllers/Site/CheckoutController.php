<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Pagseguro;
use App\Classes\Correios;
use App\Classes\Logado;
use App\Classes\Frete;
use App\Models\Site\PedidosProdutos;
use App\Models\Site\Pedidos;

class CheckoutController extends BaseController {

    private $produtosCarrinho;
    private $correios;
    private $pedidosProdutos;
    private $pedidos;

    public function index(){

        echo json_encode('Fecha o pedido do Cliente');

    }

}
