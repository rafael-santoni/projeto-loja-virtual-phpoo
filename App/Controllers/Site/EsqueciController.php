<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\UserModel;
use App\Models\Site\PasswordReminderModel;
use App\Classes\Validate;
use App\Classes\ErrorsValidate;

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

            } else {
                // Usuário não encontrado
                echo 'user';
            }

        }

    }

}
