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

        $template = $this->twig->load('site_contato.html');
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

            $validate = new Validate;
            $validate->validate($rules);

            if(!ErrorsValidate::erroValidacao()) {

                $filter = new MassFilter;
                $filter->filterInputs('nome', 'email:email', 'assunto', 'mensagem');

                $sendEmail = new SendEmail;
                $sendEmail->setMensagem([
                    'nome' => $filter->get('nome'),
                    'data' => date('d/m/Y H:i:s'),
                    'mensagem' => $filter->get('mensagem')
                ]);

                $sendEmail->send([
                    'contato@empresa.com',
                    $filter->get('email'),
                    $filter->get('assunto')
                ], new TemplateContato);

                return Redirect::redirect('/contato');

            }

            return Redirect::redirect('/contato');

        }

    }

}
