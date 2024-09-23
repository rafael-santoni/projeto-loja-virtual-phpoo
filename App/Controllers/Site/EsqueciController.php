<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\UserModel;
use App\Models\Site\PasswordReminderModel;
use App\Classes\Validate;
use App\Classes\ErrorsValidate;
use App\Classes\FlashMessage;
use App\Classes\Redirect;
use App\Classes\SendEmail;
use App\Classes\TemplateRedefinirSenha;

class EsqueciController extends BaseController {

    private $passwordReminder;

    public function __construct(){
        $this->passwordReminder = new PasswordReminderModel;
    }

    public function index(){

        $dados = [
            'title' => 'Loja Virtual - RS-Dev | Esqueci a senha'
        ];

        $template = $this->twig->loadTemplate('site_esqueci.html');
        $template->display($dados);

    }

    public function send(){

        $rules = [
            'email' => 'required|email'
        ];

        $validate = new Validate($rules);
        $validate->validate();

        if(!ErrorsValidate::erroValidacao()) {

            $emailFiltrado = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            $userModel = new UserModel;
            $userEncontrado = $userModel->find('email', $emailFiltrado);

            if($userEncontrado) {

                $this->passwordReminder->delete('user', $userEncontrado->id);
                $this->passwordReminder->create([
                    $userEncontrado->id,
                    date('Y-m-d H:i:s'),
                    date('Y-m-d H:i:s', strtotime('+1hour')),
                    IdRandom()
                ]);

                $sendEmail = new SendEmail;
                $sendEmail->setMensagem([
                    'nome' => $userEncontrado->name,
                    'copy' => 'http://localhost:8127/esqueci/senha/'.IdRandom(),
                    'link' => '<a href="http://localhost:8127/esqueci/senha/'.IdRandom().'">Cique aqui para redefinir sua senha</a>',
                    'data' => date('d/m/Y H:i:s')
                ]);

                $sendEmail->send([
                    $userEncontrado->email,
                    // 'contato@empresa.com',
                    'Loja Virtual - RS-Dev',
                    'Atualize sua senha'
                ], new TemplateRedefinirSenha);

                echo 'enviado';

            } else {
                // Usuário não encontrado
                FlashMessage::add('esqueci', 'Não encontramos esse email em nosso banco de dados.');
                echo 'user';
            }

        } else {
            echo 'erroValidate';
        }

    }

    public function senha($params){

        $dadosPassword = $this->passwordReminder->find('hash', $params[0]);

        if(!$dadosPassword){
            return Redirect::redirect();
        }

        if(strtotime($dadosPassword->expire) < strtotime(date('Y-m-d H:i:s'))) {
            return Redirect::redirect();
        }

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Redefinir Senha',
            'hash' => $dadosPassword->hash
        ];

        $template = $this->twig->loadTemplate('site_reset_password.html');
        $template->display($dados);

    }

}
