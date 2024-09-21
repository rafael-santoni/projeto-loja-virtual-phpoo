<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Validate;
use App\Classes\ErrorsValidate;
use App\Classes\Filters;
use App\Classes\Redirect;
use App\Classes\SendEmail;
use App\Classes\TemplateContato;

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

            Validate::validate($rules);

            if(!ErrorsValidate::erroValidacao()) {

                $filters = new Filters;
                $nome = $filters->filter('nome','string');
                $email = $filters->filter('email','email');
                $assunto = $filters->filter('assunto','string');
                $mensagem = $filters->filter('mensagem','string');

                $sendEmail = new SendEmail;
                $sendEmail->setMensagem([
                    'nome' => $nome,
                    'data' => date('d/m/Y H:i:s'),
                    'mensagem' => $mensagem
                ]);

                $sendEmail->send([
                    'contato@empresa.com',
                    $email,
                    $assunto
                ], new TemplateContato);

                return Redirect::redirect('/contato');

            }

            return Redirect::redirect('/contato');

        }

    }

}
