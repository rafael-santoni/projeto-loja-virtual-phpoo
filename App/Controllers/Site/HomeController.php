<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutoRepository;
use App\Classes\CarrinhosAbandonados;
use App\Classes\RetornaEstoque;
use App\Classes\Cache;
use App\Classes\Redis;

class HomeController extends BaseController {

	public function index()	{

		// $produtosVencidos = new CarrinhosAbandonados;
		// $produtosVencidos->removeProducts(new RetornaEstoque);
		CarrinhosAbandonados::remove(new RetornaEstoque);

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

		// $produtoRepository = new ProdutoRepository;
		//
		// // Listar pelo destaque
		// $produtosDestaque = $produtoRepository->listarProdutosOrdenadosPeloDestaque(6);
		//
		// // Listar pela promoção
		// $produtosPromocao = $produtoRepository->listarProdutosPromocao(6);

		$dados = [
			'titulo' => 'Loja Virtual - Eletrônicos | SmartPhones | Periféricos Para PC - RS-Dev',
			'produtos' => $produtosDestaque,
			'produtosPromocao' => $produtosPromocao
		];

		$template = $this->twig->loadTemplate('site_home.html');
		$template->display($dados);

	}

}
