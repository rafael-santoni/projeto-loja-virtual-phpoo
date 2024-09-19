<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Carrinho;
use App\Classes\CarrinhoService;
use App\Classes\EstoqueCarrinho;
use App\Classes\RetornaEstoque;
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
            'numeroProdutosCarrinho' => count(Carrinho::produtosCarrinho()),
            'valorProdutosCarrinho' => $this->produtosCarrinhoRepository->totalProdutosCarrinho()
        ]);
    }

    public function update(){

        $id = (int)$_POST['id'];
        $quantidade = (int)$_POST['qtd'];

        $estoqueCarrinho = new EstoqueCarrinho;
        $estoqueCarrinho->gerenciaEstoque($id, $quantidade);

        // if($qtd == '' || $qtd == 0) {
        //
        //     $this->carrinho->remove($id);
        //     echo 'deleted';
        //
        // } else {
        //
        //     $this->carrinho->update($id, $quantidade);
        //     echo 'updated';
        //
        // }

        $retorno = $this->carrinhoService->update($id, $quantidade);

        echo $retorno;

    }

    public function remove(){

        $id = (int)$_POST['id'];

        $retornaEstoque = new RetornaEstoque;
        $retornaEstoque->retornaProdutoEstoque($id, IdRandom());

        // unset($_SESSION['frete']);
        Frete::limparFrete();

        // $this->carrinho->remove($id);

        // echo 'deleted';

        $retorno = $this->carrinhoService->remove($id);

        echo $retorno;

    }

}
