<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Login;
use App\Classes\Filters;
use App\Classes\Redirect;
use App\Models\Site\UserLogin;

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

            $redirect = new Redirect;

            $filter = new Filters;
            $email = $filter->filter('email', 'string');
            $password = $filter->filter('password', 'string');

            $login = new Login;
            $login->setEmail($email);
            $login->setPassword($password);

            if($login->logar(new UserLogin)) {
                return $redirect->redirect('/');
            }

            return $redirect->redirect('/login');

        }

        return $redirect->redirect('/');

    }

}
