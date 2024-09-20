<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Pagseguro;
use App\Classes\CheckoutValidate;
use App\Classes\Checkout;
use App\Classes\Pedidos;
use App\Classes\User;
use App\Classes\Frete;
use App\Classes\Carrinho;
use App\Classes\IdRandom;
use App\Models\Site\UserModel;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class CheckoutController extends BaseController {

    public function index(){

        CheckoutValidate::queued();

        $pedidos = new Pedidos(new ProdutosCarrinhoRepository);
        if($pedidos->create(IdRandom())) {

            $user = new User;
            $dadosUser = $user->user(new UserModel);

            $checkout = new Checkout;
            $retorno = $checkout->checkoutAndPayment([
                'name' => $dadosUser->name,
                'sobrenome' => $dadosUser->sobrenome,
                'email' => $dadosUser->email,
                'ddd' => $dadosUser->ddd,
                'telefone' => $dadosUser->telefone,
                'idReferencia' => IdRandom()
            ], new Pagseguro);

            echo json_encode([
                'redirecionar' => 'sim',
                'url' => $retorno
            ]);

        } else {

            $pedidos->remove(IdRandom());
            echo json_encode('erroCadastro');

        }

    }

}
