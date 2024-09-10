<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Password;

class LoginController extends BaseController {

    public function index(){

        $password = new Password;
        dump($password->hash('1234'));

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
