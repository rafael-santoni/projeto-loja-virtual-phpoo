<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Validate;
use App\Classes\ErrorsValidate;
use App\Classes\FiltersValidate;
use App\Classes\Redirect;

class ContatoController extends BaseController {

    public function index(){

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Contato'
        ];

        $template = $this->twig->loadTemplate('site_contato.html');
        $template->display($dados);

    }

    public function enviar(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $rules = [
                'nome' => 'required',
                'email' => 'required|email',
                'assunto' => 'required',
                'mensagem' => 'required',
            ];

            $validate = new Validate;
            $validate->validate($rules);

            $errosValidate = new ErrorsValidate;
            $redirect = new Redirect;

            if(!$errosValidate->erroValidacao()) {

            }

            return $redirect->redirect('/contato');

        }

    }

}
