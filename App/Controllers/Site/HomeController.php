<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
// use App\Models\Site\User;
use App\Repositories\Site\ProdutoRepository;

class HomeController extends BaseController {

	public function index()	{

		// $user = new User;

		// dump($user->fetchAll());
		// dump($user->find('id',3));

		// $produtoRepository = new ProdutoRepository;
		// dump($produtoRepository->listarProdutosOrdenadosComLimite(3));

		$dados = [
			'titulo' => 'Loja Virtual - Eletrônicos | SmartPhones | Periféricos Para PC - RS-Dev'
		];

		$template = $this->twig->loadTemplate('site_home.html');
		$template->display($dados);
		
	}

}