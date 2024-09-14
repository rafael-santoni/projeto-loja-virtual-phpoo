<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Carrinho;
use App\Classes\Frete;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class CarrinhoController extends BaseController {

    private $carrinho;
    private $produtosCarrinhoRepository;

    public function __construct(){

        $this->carrinho = new Carrinho;
        $this->produtosCarrinhoRepository = new ProdutosCarrinhoRepository;

    }

    public function index(){

        $produtos = $this->produtosCarrinhoRepository->produtosNoCarrinho();

        $frete = new Frete;

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Carrinho',
            'produtos' => $produtos,
            'frete' => $frete->pegarFrete()
        ];

        $template = $this->twig->loadTemplate('site_carrinho.html');
        $template->display($dados);

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

    public function update(){

        $id = (int)$_POST['id'];
        $qtd = (int)$_POST['qtd'];

        if($qtd == '' || $qtd == 0) {

            $this->carrinho->remove($id);
            echo 'deleted';

        } else {

            $this->carrinho->update($id, $qtd);
            echo 'updated';
            
        }

    }

}
