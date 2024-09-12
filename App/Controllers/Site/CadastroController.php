<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Validate;
use App\Classes\ErrorsValidate;
use App\Classes\Redirect;
use App\Classes\Filters;
use App\Classes\PersistInput;
use App\Classes\FlashMessage;
use App\Models\Site\UserModel;

class CadastroController extends BaseController {

    private $validate;
    private $errorValidate;
    private $redirect;
    private $filter;
    private $userModel;
    private $flash;

    public function __construct(){

        $this->validate = new Validate;
        $this->errorValidate = new ErrorsValidate;
        $this->redirect = new Redirect;
        $this->filter = new Filters;
        $this->userModel = new UserModel;
        $this->flash = new FlashMessage;

    }

    public function index(){

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Cadastre-se em nosso site',
        ];

        $template = $this->twig->loadTemplate('site_cadastro.html');
        $template->display($dados);

    }

    public function cadastrar(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $rules = [
                'nome' => 'required',
                'sobrenome' => 'required',
                'email' => 'required|email',
                'ddd' => 'required|ddd',
                'telefone' => 'required|phone',
                // 'endereco' => 'required',
                // 'bairro' => 'required',
                // 'cidade' => 'required',
                // 'estado' => 'required',
                'cep' => 'required|cep',
            ];

            $this->validate->validate($rules);

            if(!$this->errorValidate->erroValidacao()) {

                $nome = $this->filter->filter('nome','string');
                $sobrenome = $this->filter->filter('sobrenome','string');
                $email = $this->filter->filter('email','email');
                $ddd = $this->filter->filter('ddd','string');
                $telefone = $this->filter->filter('telefone','string');
                $endereco = $this->filter->filter('endereco','string');
                $bairro = $this->filter->filter('bairro','string');
                $cidade = $this->filter->filter('cidade','string');
                $estado = $this->filter->filter('estado','string');
                $cep = $this->filter->filter('cep','string');

                $attributes = [$nome,$sobrenome,$email,$ddd,$telefone,$endereco,$bairro,$cidade,$estado,$cep];

                if($this->userModel->create($attributes)) {

                    $this->flash->add('mensagem_cadastro', 'Cadastrado com sucesso!', 'success');

                    PersistInput::removeInputs();

                    return $this->redirect->redirect('/cadastro');

                }

                $this->flash->add('mensagem_cadastro', 'Erro ao cadastrar, tente novamente mais tarde!');

                return $this->redirect->redirect('/cadastro');

            } else {
                $this->redirect->redirect('/cadastro');
            }

        }

    }

    public function atualizar(){

    }

}
