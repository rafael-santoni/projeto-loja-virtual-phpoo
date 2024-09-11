<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\ProdutoModel;
use App\Models\Site\MarcaModel;
use App\Classes\Redirect;

class MarcaController extends BaseController {


    public function index($params){

        $marcaModel = new MarcaModel;
        $marcasEncontradas = $marcaModel->find('marca_slug', $params[0]);

        $redirect = new Redirect;
        if(!$marcasEncontradas) {
            $redirect->redirect('/');
        }

        $produtoModel = new ProdutoModel;
        $produtosEncontrados = $produtoModel->find('produto_marca', $marcasEncontradas->id, 'all');

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Home Marcas',
            'produtos' => $produtosEncontrados,
            'marca' => $marcasEncontradas
        ];

        $template = $this->twig->loadTemplate('site_marcas.html');
        $template->display($dados);

    }

}
