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

        // $template = $this->twig->loadTemplate('site_contato.html');
        $template = $this->twig->load('site_contato.html');
        // $template->display($dados);
        echo $template->render($dados);

    }

    public function enviar(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $rules = [
                'nome' => 'required',
                'email' => 'required|email',
                'assunto' => 'required',
                'mensagem' => 'required',
            ];

            // Validate::validate($rules);
            $validate = new Validate;
            $validate->validate($rules);

            if(!ErrorsValidate::erroValidacao()) {

                // $filters = new Filters;
                // $nome = $filters->filter('nome','string');
                // $email = $filters->filter('email','email');
                // $assunto = $filters->filter('assunto','string');
                // $mensagem = $filters->filter('mensagem','string');

                $filter = new MassFilter;
                $filter->filterInputs('nome', 'email:email', 'assunto', 'mensagem');

                $sendEmail = new SendEmail;
                $sendEmail->setMensagem([
                    // 'nome' => $nome,
                    'nome' => $filter->get('nome'),
                    'data' => date('d/m/Y H:i:s'),
                    // 'mensagem' => $mensagem
                    'mensagem' => $filter->get('mensagem')
                ]);

                $sendEmail->send([
                    'contato@empresa.com',
                    // $email,
                    $filter->get('email'),
                    // $assunto
                    $filter->get('assunto')
                ], new TemplateContato);

                return Redirect::redirect('/contato');

            }

            return Redirect::redirect('/contato');

        }

    }

}
