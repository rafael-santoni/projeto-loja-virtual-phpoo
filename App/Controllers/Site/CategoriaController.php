<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\ProdutoModel;
use App\Models\Site\CategoriaModel;
use App\Classes\Redirect;

class CategoriaController extends BaseController {

    public function index($params){

        $categoriaModel = new CategoriaModel;
        $categoriaEncontrada = $categoriaModel->find('categoria_slug', $params[0]);

        $redirect = new Redirect;
        if(!$categoriaEncontrada) {
            $redirect->redirect('/');
        }

        $produtoModel = new ProdutoModel;
        $produtosEncontrados = $produtoModel->find('produto_categoria', $categoriaEncontrada->id,'all');

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Home Categorias',
            'produtos' => $produtosEncontrados,
            'categoria' => $categoriaEncontrada
        ];

        $template = $this->twig->load('site_categoria.html');
        echo $template->render($dados);

    }

}
