<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\PedidosRepository;
use App\Classes\Authenticated;
use App\Classes\Logado;
use App\Classes\Redirect;

class ComprasController extends BaseController {

    public function index(){

        if(!Logado::logado()) return Redirect::redirect();

        $pedidos = new PedidosRepository;
        $dadosPedidos = $pedidos->pedidos(Authenticated::user()->id);

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Minhas Compras',
            'pedidos' => $dadosPedidos
        ];

        $template = $this->twig->load('site_minhas_compras.html');
        echo $template->render($dados);

    }

}
