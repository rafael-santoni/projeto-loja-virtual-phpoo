<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Login;
use App\Classes\Filters;
use App\Classes\Redirect;
use App\Classes\Logado;
use App\Models\Site\UserLogin;

class LoginController extends BaseController {

    private $redirect;

    public function __construct(){
        $this->redirect = new Redirect;
    }

    public function index(){

        $logado = new Logado;
        if($logado->logado()) {
            $this->redirect->redirect('/');
        }

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Login',
        ];

        $template = $this->twig->loadTemplate('site_login.html');
        $template->display($dados);

    }

    public function logar(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $filter = new Filters;
            $email = $filter->filter('email', 'string');
            $password = $filter->filter('password', 'string');

            $login = new Login;
            $login->setEmail($email);
            $login->setPassword($password);

            if($login->logar(new UserLogin)) {
                return $this->redirect->redirect('/');
            }

            return $this->redirect->redirect('/login');

        }

        return $this->redirect->redirect('/');

    }

}
