<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Logar;
use App\Classes\Logado;
use App\Classes\Logout;
// use App\Classes\Filters;
use App\Classes\MassFilter;
use App\Classes\Redirect;
use App\Classes\FlashMessage;

class LoginController extends BaseController {

    public function index(){

        if(Logado::logado()) Redirect::redirect();

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Login',
        ];

        $template = $this->twig->loadTemplate('site_login.html');
        $template->display($dados);

    }

    public function logar(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $filter = new MassFilter;
            $filter->filterInputs('email', 'password');

            if(Logar::logarUser($filter->get('email'), $filter->get('password'))) return Redirect::redirect();

            FlashMessage::add('login','Erro ao logar, usuário e/ou senha inválidos');

            return Redirect::redirect('/login');

        }

        return Redirect::redirect();

    }

    public function logout(){

        Logout::logoutUser();

        Redirect::redirect();

    }

}
