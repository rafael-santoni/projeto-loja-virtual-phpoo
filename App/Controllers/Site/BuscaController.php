<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;

class BuscaController extends BaseController {

    private $produto;

    public function __construct(){
        $this->produto = new ProdutoRepository;
    }

    public function index(){

        $busca = filter_input(INPUT_GET,'b',FILTER_SANITIZE_STRING);
        $produtosEncontrados = $this->produto->buscarProduto($busca);

        $dados = [
            'title' => 'Loja Virtual - RS-Dev | Busca',
            'produtos' => $produtosEncontrados
        ];

        // $template = $this->twig->loadTemplate('site_busca.html');
        $template = $this->twig->load('site_busca.html');
        // $template->display($dados);
        echo $template->render($dados);

    }

}
