<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;
// use App\Classes\CarrinhosAbandonados;
// use App\Classes\RetornaEstoque;
use App\Classes\Cache;
use App\Classes\Redis;

class HomeController extends BaseController {

	public function index()	{

		// CarrinhosAbandonados::remove(new RetornaEstoque);

		$produtoRepository = new ProdutoRepository;
		$cache = new Cache(new Redis($this->cache));

		// Lista de produtos em destaque
		$cache->set('produtos_destaque', $produtoRepository->listarProdutosOrdenadosPeloDestaque(6));
		$produtosDestaque = $cache->get('produtos_destaque');

		// Lista de produtos em promoção
		$cache->set('produtos_promocao', $produtoRepository->listarProdutosPromocao(6));
		$produtosPromocao = $cache->get('produtos_promocao');

		$cache->expire('produtos_destaque');
		$cache->expire('produtos_promocao');

		$dados = [
			'titulo' => 'Loja Virtual - Eletrônicos | SmartPhones | Periféricos Para PC - RS-Dev',
			'produtos' => $produtosDestaque,
			'produtosPromocao' => $produtosPromocao
		];

		// $template = $this->twig->loadTemplate('site_home.html');
		$template = $this->twig->load('site_home.html');
		// $template->display($dados);
		echo $template->render($dados);

	}

}
