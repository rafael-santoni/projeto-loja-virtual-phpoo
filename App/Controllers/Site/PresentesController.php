<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;

class PresentesController extends BaseController {

    public function index(){

        $produtoRepository = new ProdutoRepository;
        $produtosParaPresente = $produtoRepository->listarProdutosParaPresentes();

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Produtos para Presente',
            'produtos' => $produtosParaPresente
        ];

        $template = $this->twig->loadTemplate('site_presentes.html');
        $template->display($dados);

    }

}
