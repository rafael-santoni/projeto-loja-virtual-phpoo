<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Models\Site\ProdutoModel;
use App\Classes\Cache;
use App\Classes\Redis;

class DetalhesController extends BaseController {

	private $produto;

	public function __construct(){
		$this->produto = new ProdutoModel;
	}

	public function index($params){

		$cache = new Cache(new Redis($this->cache));
		$cache->incr('prod_'.$params[0]);

		$produtoEncontrado = $this->produto->find('produto_slug', $params[0]);

		$dados = [
			'titulo' => 'Detalhes do produto '.$produtoEncontrado->produto_nome,
			'produto' => $produtoEncontrado
		];

		$template = $this->twig->loadTemplate('site_detalhes.html');
		$template->display($dados);

	}

}
