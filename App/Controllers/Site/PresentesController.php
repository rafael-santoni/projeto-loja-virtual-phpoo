<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;
use App\Classes\Cache;
use App\Classes\Redis;

class PresentesController extends BaseController {

    public function index(){

        $produtoRepository = new ProdutoRepository;
        $cache = new Cache(new Redis($this->cache));

        $cache->set('produtos_presentes', $produtoRepository->listarProdutosParaPresentes());
        $produtosParaPresentes = $cache->get('produtos_presentes');

        $cache->expire('produtos_presentes');

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Produtos para Presente',
            'produtos' => $produtosParaPresentes
        ];

        // $template = $this->twig->loadTemplate('site_presentes.html');
        $template = $this->twig->load('site_presentes.html');
        // $template->display($dados);
        echo $template->render($dados);

    }

}
