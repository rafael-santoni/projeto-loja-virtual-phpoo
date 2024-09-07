<?php

use App\Repositories\Site\CategoriaRepository;
use App\Repositories\Site\ProdutoRepository;

$site_url = new \Twig_SimpleFunction('site_url', function(){
	return 'http://'.$_SERVER['SERVER_NAME'].':8127';
});

// Listar as categorias no left menu
$categorias = new \Twig_SimpleFunction('categorias', function(){
	$categoriaRepository = new CategoriaRepository;
	
	return $categoriaRepository->listarCategoriasProdutos();
});

// Listar as novidades no right menu
$novidade = new \Twig_SimpleFunction('novidade', function(){
	$produtoRepository = new ProdutoRepository;
	
	return $produtoRepository->ultimoProdutoAdicionado();
});

// Listar produtos em promoção no left menu
$promocao = new \Twig_SimpleFunction('promocao', function(){
	$produtoRepository = new ProdutoRepository;
	
	return $produtoRepository->listarProdutosPromocao(1);
});