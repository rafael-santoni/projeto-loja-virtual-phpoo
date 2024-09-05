<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;

class HomeController extends BaseController {

	public function index()	{

		$dados = [
			'titulo' => 'Loja Virtual - Eletrônicos | SmartPhones | Periféricos Para PC - RS-Dev'
		];

		$template = $this->twig->loadTemplate('site_home.html');
		$template->display($dados);
		
	}

}