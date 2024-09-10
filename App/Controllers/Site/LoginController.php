<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;

class LoginController extends BaseController {

    public function index(){

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Login',
        ];

        $template = $this->twig->loadTemplate('site_login.html');
        $template->display($dados);

    }

    public function logar(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            dump("Acesso válido, fazer o login");
        }

        header('Location:/');

    }

}
