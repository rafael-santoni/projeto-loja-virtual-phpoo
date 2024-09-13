<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Validate;
use App\Classes\ErrorsValidate;
use App\Classes\Filters;
use App\Classes\Redirect;
use App\Classes\Email;
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

            $validate = new Validate;
            $validate->validate($rules);

            $errosValidate = new ErrorsValidate;
            $redirect = new Redirect;

            if(!$errosValidate->erroValidacao()) {

                $filters = new Filters;
                $nome = $filters->filter('nome','string');
                $email = $filters->filter('email','email');
                $assunto = $filters->filter('assunto','string');
                $mensagem = $filters->filter('mensagem','string');

                $phpMailer = new Email();
                $phpMailer->setPara('contato@empresa.com.br');
                $phpMailer->setQuem($email);
                $phpMailer->setAssunto($assunto);
                $phpMailer->setMensagem([
                    'nome' => $nome,
                    'data' => date('d/m/Y H:i:s'),
                    'mensagem' => $mensagem
                ]);
                $phpMailer->setTemplate(new TemplateContato);

                if($phpMailer->enviar()) {
                    $redirect->redirect('/contato');
                }

            }

            return $redirect->redirect('/contato');

        }

    }

}
