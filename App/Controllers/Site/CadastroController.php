<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Classes\Validate;
use App\Classes\RepeatedRegistersSite;
use App\Classes\ErrorsValidate;
use App\Classes\Redirect;
use App\Classes\MassFilter;
// use App\Classes\Filters;
use App\Classes\PersistInput;
use App\Classes\FlashMessage;
use App\Classes\Logar;
use App\Classes\Logado;
use App\Classes\Password;
use App\Models\Site\UserModel;

class CadastroController extends BaseController {

    // private $filter;
    //
    // public function __construct(){
    //     $this->filter = new Filters;
    // }

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

                // $nome = $this->filter->filter('nome','string');
                // $sobrenome = $this->filter->filter('sobrenome','string');
                // $email = $this->filter->filter('email','email');
                // $password = $this->filter->filter('password','string');
                // $ddd = $this->filter->filter('ddd','string');
                // $telefone = $this->filter->filter('telefone','string');
                // $endereco = $this->filter->filter('endereco','string');
                // $bairro = $this->filter->filter('bairro','string');
                // $cidade = $this->filter->filter('cidade','string');
                // $cep = $this->filter->filter('cep','string');
                // $estado = $this->filter->filter('estado','string');
                //
                // $attributes = [$nome,$sobrenome,2,$email,Password::hash($password),$ddd,$telefone,$endereco,$bairro,$cidade,$cep,$estado];

                $filter = new MassFilter;
                $filter->filterInputs('nome', 'sobrenome', 'is_admin:int=2', 'email:email', 'password', 'ddd', 'telefone', 'endereco', 'bairro', 'cidade', 'cep', 'estado');

                $userModel = new UserModel;
                if($userModel->create($attributes)) {

                    FlashMessage::add('mensagem_cadastro', 'Cadastrado com sucesso!', 'success');

                    PersistInput::removeInputs();

                    Logar::logarUser($email, $password);
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
