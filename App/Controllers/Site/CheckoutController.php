<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Pagseguro;
use App\Classes\CheckoutValidate;
use App\Classes\Pedidos;
use App\Classes\User;
use App\Classes\Frete;
use App\Classes\Carrinho;
use App\Classes\IdRandom;
use App\Models\Site\UserModel;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class CheckoutController extends BaseController {

    public function index(){

        // $checkoutValidate = new CheckoutValidate;
        // if(!$checkoutValidate->validateCheckout()) {
        //
        //     echo json_encode($checkoutValidate->erro);
        //     die();
        //
        // }
        CheckoutValidate::queued();

        $pedidos = new Pedidos(new ProdutosCarrinhoRepository);
        if($pedidos->create(IdRandom::generateId())) {

            // $frete = new Frete;
            //
            // $data = [
            //     'produtos' => (object)[
            //         'id' => 1,
            //         'produto_nome' => 'Frete'
            //     ],
            //     'qtd' => 1,
            //     'valor' => $frete->pegarFrete()
            // ];

            $produtosCarrinhoRepository = new ProdutosCarrinhoRepository;
            $produtosCarrinho = $produtosCarrinhoRepository->produtosNoCarrinho();

            array_push($produtosCarrinho, $data);

            $user = new User;
            $dadosUser = $user->user(new UserModel);

            $pagseguro = new Pagseguro;
            $pagseguro->setItemAdd($produtosCarrinho);
            $pagseguro->setNome($dadosUser->name);
            $pagseguro->setSobreNome($dadosUser->sobrenome);
            $pagseguro->setEmail($dadosUser->email);
            $pagseguro->setDdd($dadosUser->ddd);
            $pagseguro->setTelefone($dadosUser->telefone);
            $pagseguro->setIdReferencia(IdRandom::generateId());

            $carrinho = new Carrinho;
            try {

                // $url = $pagseguro->enviarPagseguro();    ## DEScomentar para usar no Ambiente de Produção
                $url = '/';    ## COMENTAR esta linha para usar no Ambiente de Produção

                $retorno = [
                    'url' => $url,
                    'redirecionar' => 'sim'
                ];

                $carrinho->clear();
                $frete->limparFrete();
                IdRandom::clear();

                echo json_encode($retorno);

            } catch (\Exception $e) {
                echo json_encode($e->getMessage());
            }

        } else {
            $pedidos->remove(IdRandom::generateId());
            echo json_encode('erroCadastro');
        }

    }

}
