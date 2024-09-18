<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Carrinho;
use App\Classes\CarrinhoService;
use App\Classes\Frete;
use App\Classes\CarrinhoProdutosVencidos;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class CarrinhoController extends BaseController {

    private $carrinho;
    private $carrinhoService;
    private $produtosCarrinhoRepository;

    public function __construct(){

        $this->carrinho = new Carrinho;
        $this->carrinhoService = new CarrinhoService;
        $this->produtosCarrinhoRepository = new ProdutosCarrinhoRepository;

    }

    public function index(){

        $produtosVencidos = new CarrinhoProdutosVencidos;
		$produtosVencidos->verificarProdutosVencidosCarrinho();

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

        $id = $param[0];
        if($this->estoque->estoqueAtual($id) > 0){

            $this->carrinhoService->add($id);
            $this->estoque->atualizaEstoque($id, ($this->estoque->estoqueAtual($id) - 1));

        }

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

    public function delete(){

        $id = (int)$_POST['id'];

        $this->carrinho->remove($id);

        unset($_SESSION['frete']);

        echo 'deleted';

    }

}
