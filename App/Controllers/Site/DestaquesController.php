<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;

class DestaquesController extends BaseController
{

    public function index($params){

        $produtoRepository = new ProdutoRepository;
        $produtosDestaque = $produtoRepository->listarProdutosEmDestaque();

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Produtos em Destaque',
            'produtos' => $produtosDestaque
        ];

        $template = $this->twig->loadTemplate('site_destaques.html');
        $template->display($dados);

    }
}
