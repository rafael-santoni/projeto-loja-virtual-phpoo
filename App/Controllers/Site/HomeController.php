<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
// use App\Models\Site\User;
use App\Repositories\Site\ProdutoRepository;

class HomeController extends BaseController {

	public function index()	{

		$produtoRepository = new ProdutoRepository;
		$produtosDestaque = $produtoRepository->listarProdutosOrdenadosPeloDestaque(6);

		$dados = [
			'titulo' => 'Loja Virtual - Eletrônicos | SmartPhones | Periféricos Para PC - RS-Dev',
			'produtos' => $produtosDestaque
		];

		$template = $this->twig->loadTemplate('site_home.html');
		$template->display($dados);
		
	}

}