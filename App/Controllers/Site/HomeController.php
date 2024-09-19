<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;
use App\Classes\CarrinhosAbandonados;
use App\Classes\RetornaEstoque;

class HomeController extends BaseController {

	public function index()	{

		// $produtosVencidos = new CarrinhosAbandonados;
		// $produtosVencidos->removeProducts(new RetornaEstoque);
		CarrinhosAbandonados::remove(new RetornaEstoque);

		$produtoRepository = new ProdutoRepository;

		// Listar pelo destaque
		$produtosDestaque = $produtoRepository->listarProdutosOrdenadosPeloDestaque(6);

		// Listar pela promoção
		$produtosPromocao = $produtoRepository->listarProdutosPromocao(6);

		$dados = [
			'titulo' => 'Loja Virtual - Eletrônicos | SmartPhones | Periféricos Para PC - RS-Dev',
			'produtos' => $produtosDestaque,
			'produtosPromocao' => $produtosPromocao
		];

		$template = $this->twig->loadTemplate('site_home.html');
		$template->display($dados);

	}

}
