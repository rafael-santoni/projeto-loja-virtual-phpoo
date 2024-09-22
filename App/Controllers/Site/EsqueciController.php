<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;

class EsqueciController extends BaseController {

    public function index(){

        $dados = [
            'title' => 'Loja Virtual - RS-Dev | Esqueci a senha'
        ];

        $template = $this->twig->loadTemplate('site_esqueci.html');
        $template->display($dados);

    }

}
