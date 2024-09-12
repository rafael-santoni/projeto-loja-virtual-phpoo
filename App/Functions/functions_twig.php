<?php

// use App\Repositories\Site\CategoriaRepository;
use App\Repositories\Site\ProdutoRepository;
use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Classes\BreadCrumb;
use App\Classes\Carrinho;
use App\Classes\Frete;
use App\Classes\Logado;
use App\Classes\ErrorsValidate;
use App\Models\Site\MarcaModel;
use App\Models\Site\CategoriaModel;
use App\Models\Site\UserModel;

$site_url = new \Twig_SimpleFunction('site_url', function(){
	return 'http://'.$_SERVER['SERVER_NAME'].':8127';
});

// Listar as categorias no left menu
$categorias = new \Twig_SimpleFunction('categorias', function(){
	// $categoriaRepository = new CategoriaRepository;

	// return $categoriaRepository->listarCategoriasProdutos();
	$categoriaModel = new CategoriaModel;

	return $categoriaModel->fetchAll();
});

// Listar as marcas no right menu
$marcas = new \Twig_SimpleFunction('marcas', function(){
	$marcaModel = new MarcaModel;

	return $marcaModel->fetchAll();
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

// Bread crumb
$breadCrumb = new \Twig_SimpleFunction('breadCrumb', function(){
	$breadCrumb = new BreadCrumb;

	return $breadCrumb->createBreadCrumb();
});

// Valor total dos produtos no carrinho
$valorProdutosCarrinho = new \Twig_SimpleFunction('valorProdutosCarrinho', function(){
	$produtosCarrinhoRepository = new ProdutosCarrinhoRepository;

	return $produtosCarrinhoRepository->totalProdutosCarrinho();
});

// Número de produtos no carrinho
$numeroProdutosCarrinho = new \Twig_SimpleFunction('numeroProdutosCarrinho', function(){
	$produtosCarrinho = new Carrinho;

	return $produtosCarrinho->produtosCarrinho();
});

// // Pegar dados do frete
// $dadosFrete = new \Twig_SimpleFunction('dadosFrete', function(){
// 	return new Frete;
// });

// Valor Total da Compra
$totalComFrete = new \Twig_SimpleFunction('totalComFrete', function(){

	$carrinho = new ProdutosCarrinhoRepository;
	$totalCompra = $carrinho->totalProdutosCarrinho();

	$frete = new Frete;
	$valorFrete = $frete->pegarFrete();

	return $valorFrete + $totalCompra;

});

// Verifica se o usuário está logado
$logado = new \Twig_SimpleFunction('logado', function(){
	$logado = new Logado;

	return $logado->logado();
});

// Pegar dados do usuário
$user = new \Twig_SimpleFunction('user', function(){
	$userModel = new UserModel;

	return $userModel->find('id', $_SESSION['id']);
});

// Mensagens de erro do formulário
$errorField = new \Twig_SimpleFunction('errorField', function($field){
	$errorValidate = new ErrorsValidate;

	return $errorValidate->show($field);
});
