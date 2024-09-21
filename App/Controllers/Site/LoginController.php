<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
// use App\Classes\Login;
use App\Classes\Logar;
use App\Classes\Filters;
use App\Classes\Redirect;
use App\Classes\Logado;
// use App\Models\Site\UserModel;

class LoginController extends BaseController {

    // private $redirect;
    //
    // public function __construct(){
    //     $this->redirect = new Redirect;
    // }

    public function index(){

        $logado = new Logado;
        if($logado->logado()) {
            Redirect::redirect('/');
        }

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Login',
        ];

        $template = $this->twig->loadTemplate('site_login.html');
        $template->display($dados);

    }

    public function logar(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // $filter = new Filters;
            $email = Filters::filter('email', 'string');
            $password = Filters::filter('password', 'string');

            // $login = new Login;
            // $login->setEmail($email);
            // $login->setPassword($password);

            // if($login->logar(new UserModel)) {
            if(Logar::logarUser($email, $password)) {
                return Redirect::redirect('/');
            }

            return Redirect::redirect('/login');

        }

        return Redirect::redirect('/');

    }

    public function logout(){

        //session_destroy();

        unset($_SESSION['id']);
        unset($_SESSION['name']);
        unset($_SESSION['logado']);

        Redirect::redirect('/');

    }

}
