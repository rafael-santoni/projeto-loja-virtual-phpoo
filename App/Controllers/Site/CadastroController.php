<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Redirect;
use App\Classes\Logado;
use App\Models\Site\UserModel;

class CadastroController extends BaseController {

    public function index(){

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Cadastre-se em nosso site',
        ];

        $template = $this->twig->loadTemplate('site_cadastro.html');
        $template->display($dados);

    }

    public function cadastrar(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            dump('cadastrar ususário no banco');

        }

    }

}
