<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Pagseguro;
use App\Classes\CheckoutValidate;
use App\Classes\Logado;
use App\Classes\Frete;
use App\Classes\Carrinho;
use App\Classes\IdRandom;
use App\Models\Site\PedidosProdutosModel;
use App\Models\Site\PedidosModel;
use App\Models\Site\UserModel;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class CheckoutController extends BaseController {

    private $produtosCarrinho;
    private $pedidosProdutos;
    private $pedidos;

    public function __construct(){

        $this->produtosCarrinho = new ProdutosCarrinhoRepository;
        $this->pedidosProdutos = new PedidosProdutosModel;
        $this->pedidos = new PedidosModel;

    }

    public function index(){

        // pegando os produtos do carrinho
        $produtosCarrinho = new ProdutosCarrinhoRepository;

        $checkoutValidate = new CheckoutValidate;
        if(!$checkoutValidate->validateCheckout()) {
            echo json_encode($checkoutValidate->erro);
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
        if($this->pedidos->create([$_SESSION['id'],date('Y-m-d H:i:s'),$frete->pegarFrete(),2,IdRandom::generateId(), $this->produtosCarrinho->totalProdutosCarrinho()])) {
            $pedidoCadastrado = true;
        }

        if($pedidosCadastrado && $pedidoCadastrado) {

            $pagseguro = new Pagseguro;

            $data = [
                'produtos' => (object)[
                    'id' => 1,
                    'produto_nome' => 'Frete'
                ],
                'qtd' => 1,
                'valor' => $frete->pegarFrete()
            ];

            array_push($produtosCarrinho, $data);

            $userModel = new UserModel;
            $dadosUser = $userModel->find('id',$_SESSION['id']);

            $pagseguro->setItemAdd($produtosCarrinho);
            $pagseguro->setNome($dadosUser->name);
            $pagseguro->setSobreNome($dadosUser->sobrenome);
            $pagseguro->setEmail($dadosUser->email);
            $pagseguro->setDdd($dadosUser->ddd);
            $pagseguro->setTelefone($dadosUser->telefone);
            $pagseguro->setIdReferencia(IdRandom::generateId());

            $carrinho = new Carrinho;
            try {

                $url = '/'; // $pagseguro->enviarPagseguro();

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

        }

    }

}
