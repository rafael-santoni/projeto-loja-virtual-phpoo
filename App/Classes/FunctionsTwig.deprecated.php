<?php
/*
    --************************--
    ***** Deprecated Class *****
    --************************--

namespace App\Classes;

use App\Repositories\Site\ProdutoRepository;
use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Classes\BreadCrumb;
use App\Classes\Carrinho;
use App\Classes\Estoque;
use App\Classes\Frete;
use App\Classes\Logado;
use App\Classes\ErrorsValidate;
use App\Classes\PersistInput;
use App\Classes\FlashMessage;
use App\Models\Site\MarcaModel;
use App\Models\Site\CategoriaModel;
use App\Models\Site\UserModel;
use Predis\Client;

class FunctionsTwig {

    public $functions = [];

    private function siteUrl(){

        $this->functions['site_url'] = new \Twig_SimpleFunction('site_url', function(){
        	return 'http://'.$_SERVER['SERVER_NAME'].':8127';
        });

        return $this;

    }

    private function categorias(){

        // Listar as categorias no left menu
        $this->functions['categorias'] = new \Twig_SimpleFunction('categorias', function(){

        	$categoriaModel = new CategoriaModel;
        	return $categoriaModel->fetchAll();

        });

        return $this;

    }

    private function marcas(){

        // Listar as marcas no right menu
        $this->functions['marcas'] = new \Twig_SimpleFunction('marcas', function(){

        	$marcaModel = new MarcaModel;
        	return $marcaModel->fetchAll();

        });

        return $this;

    }

    private function novidade(){

        // Listar as novidades no right menu
        $this->functions['novidade'] = new \Twig_SimpleFunction('novidade', function(){

        	$produtoRepository = new ProdutoRepository;
        	return $produtoRepository->ultimoProdutoAdicionado();

        });

        return $this;

    }

    private function promocao(){

        // Listar produtos em promoção no left menu
        $this->functions['promocao'] = new \Twig_SimpleFunction('promocao', function(){

        	$produtoRepository = new ProdutoRepository;
        	return $produtoRepository->listarProdutosPromocao(1);

        });

        return $this;

    }

    private function breadCrumb(){

        // Bread crumb
        $this->functions['breadCrumb'] = new \Twig_SimpleFunction('breadCrumb', function(){

        	$breadCrumb = new BreadCrumb;
        	return $breadCrumb->createBreadCrumb();

        });

        return $this;

    }

    private function valorProdutosCarrinho(){

        // Valor total dos produtos no carrinho
        $this->functions['valorProdutosCarrinho'] = new \Twig_SimpleFunction('valorProdutosCarrinho', function(){

        	$produtosCarrinhoRepository = new ProdutosCarrinhoRepository;
        	return $produtosCarrinhoRepository->totalProdutosCarrinho();

        });

        return $this;

    }

    private function numeroProdutosCarrinho(){

        // Número de produtos no carrinho
        $this->functions['numeroProdutosCarrinho'] = new \Twig_SimpleFunction('numeroProdutosCarrinho', function(){

        	$produtosCarrinho = new Carrinho;
        	return $produtosCarrinho->produtosCarrinho();

        });

        return $this;

    }

    // private function dadosFrete(){
    //
    //     // Pegar dados do frete
    //     $this->functions['dadosFrete'] = new \Twig_SimpleFunction('dadosFrete', function(){
    //     	return new Frete;
    //     });
    //
    //     return $this;
    //
    // }

    private function totalComFrete(){

        // Valor Total da Compra
        $this->functions['totalComFrete'] = new \Twig_SimpleFunction('totalComFrete', function(){

        	$carrinho = new ProdutosCarrinhoRepository;
        	$totalCompra = $carrinho->totalProdutosCarrinho();

        	$frete = new Frete;
        	$valorFrete = $frete->pegarFrete();

        	return $valorFrete + $totalCompra;

        });

        return $this;

    }

    private function logado(){

        // Verifica se o usuário está logado
        $this->functions['logado'] = new \Twig_SimpleFunction('logado', function(){

        	$logado = new Logado;
        	return $logado->logado();

        });

        return $this;

    }

    private function user(){

        // Pegar dados do usuário
        $this->functions['user'] = new \Twig_SimpleFunction('user', function(){

        	$userModel = new UserModel;
        	return $userModel->find('id', $_SESSION['id']);

        });

        return $this;

    }

    private function errorField(){

        // Mensagens de erro do formulário
        $this->functions['errorField'] = new \Twig_SimpleFunction('errorField', function($field){

        	$errorValidate = new ErrorsValidate;
        	return $errorValidate->show($field);

        });

        return $this;

    }

    private function persist(){

        // Perisistir os dados no formulário
        $this->functions['persist'] = new \Twig_SimpleFunction('persist', function($field){

        	$persist = new PersistInput;
        	return $persist->show($field);

        });

        return $this;

    }

    private function flash(){

        // Mostrar mensagens no template
        $this->functions['flash'] = new \Twig_SimpleFunction('flash', function($index){

        	$flash = new FlashMessage;
        	return $flash->show($index);

        });

        return $this;

    }

    private function estoque(){

        // Estoque dos produtos
        $this->functions['estoque'] = new \Twig_SimpleFunction('estoque', function($id){

        	$estoque = new Estoque;
        	return $estoque->estoqueAtual($id);

        });

        return $this;

    }

    private function cliquesProduto(){

        $cache = new Client;

        // Quantidades de cliques de um produto
        $this->functions['cliquesProduto'] = new \Twig_SimpleFunction('cliquesProduto', function($slug) use($cache){
        	// return (isset($cache->get('prod_'.$slug))) ? $cache->get('prod_'.$slug) : 0;
        	return $cache->get('prod_'.$slug) ?? 0;
        });

        return $this;

    }

    private function statusPagamento(){

        // Estoque dos produtos
        $this->functions['statusPagamento'] = new \Twig_SimpleFunction('statusPagamento', function($status){

        	switch ($status) {
        		case '1':
        			return "Aguardando Pagamento";
        			break;

        		case '2':
        			return "Pagamento em Análise";
        			break;

        		case '3':
        			return "Venda Aprovada";
        			break;

        		case '4':
        			return "Pagamento Disponível";
        			break;

        		case '5':
        			return "Em Disputa";
        			break;

        		case '6':
        			return "Valor Devolvido";
        			break;

        		case '7':
        			return "Compra Cancelada";
        			break;

        	}

        });

        return $this;

    }

    private function statusPedido(){

        // Verificar o Status do pedido
        $this->functions['statusPedido'] = new \Twig_SimpleFunction('statusPedido', function($status){
        	return ($status == 1) ? 'positive' : 'negative';
        });

        return $this;

    }

    public function run(){

        $this->siteUrl()
        ->categorias()
        ->marcas()
        ->novidade()
        ->promocao()
        ->breadCrumb()
        ->valorProdutosCarrinho()
        ->numeroProdutosCarrinho()
        // ->dadosFrete()
        ->totalComFrete()
        ->logado()
        ->user()
        ->errorField()
        ->persist()
        ->flash()
        ->estoque()
        ->cliquesProduto()
        ->statusPedido()
        ->statusPagamento();

    }

}
*/