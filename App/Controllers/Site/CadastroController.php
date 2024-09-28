<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Validate;
use App\Classes\RepeatedRegistersSite;
use App\Classes\ErrorsValidate;
use App\Classes\Redirect;
use App\Classes\MassFilter;
use App\Classes\PersistInput;
use App\Classes\FlashMessage;
use App\Classes\Logar;
use App\Classes\Logado;
use App\Models\Site\UserModel;

class CadastroController extends BaseController {

    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel;
    }

    public function index(){

        $dados = [
            'titulo' => 'Loja Virtual - RS-Dev | Cadastre-se em nosso site',
        ];

        $template = $this->twig->load('site_cadastro.html');
        echo $template->render($dados);

    }

    public function cadastrar(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $rules = [
                'nome' => 'required',
                'sobrenome' => 'required',
                'email' => 'required|email:user',
                'ddd' => 'required',
                'telefone' => 'required',
                'endereco' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'cep' => 'required',
                'estado' => 'required',
            ];

            $validate = new Validate($rules);
            $validate->validate($rules)->repeatedRegisters(new RepeatedRegistersSite);

            if(!ErrorsValidate::erroValidacao()) {

                $filter = new MassFilter;
                $filter->filterInputs('nome', 'sobrenome', 'is_admin:int=2', 'email:email', 'password', 'ddd:int',
                                      'telefone:int', 'endereco', 'bairro', 'cidade', 'cep', 'estado');

                if($this->userModel->create($filter->all(true))) {

                    FlashMessage::add('mensagem_cadastro', 'Cadastrado com sucesso!', 'success');

                    PersistInput::removeInputs();

                    Logar::logarUser($filter->get('email'), $filter->get('password'));
                    if(Logado::logado()) return Redirect::redirect();

                    return Redirect::redirect('/cadastro');

                }

                FlashMessage::add('mensagem_cadastro', 'Erro ao cadastrar, tente novamente mais tarde!');

                return Redirect::redirect('/cadastro');

            } else {
                Redirect::redirect('/cadastro');
            }

        }

    }

    public function atualizar(){

    }

}
