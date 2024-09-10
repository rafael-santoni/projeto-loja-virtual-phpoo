<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Classes\Correios;

class FreteController extends BaseController {

    private $produtoCarrinhoRepository;
    private $correios;

    public function __construct(){
        $this->produtoCarrinhoRepository = new ProdutosCarrinhoRepository;
        $this->correios = new Correios;
    }

    public function calcular(){

        if(empty($this->produtoCarrinhoRepository->produtosNoCarrinho())){
            echo json_encode('produto'); die();
        }
        
        $cep = filter_input(INPUT_POST, 'frete', FILTER_SANITIZE_STRING);
        $this->correios->setFormato('rolo');
        $this->correios->setTipo('sedex');
        $this->correios->setCepOrigem('59040360');
        $this->correios->setCepDestino(str_replace('-','',$cep));
        $this->correios->setPeso('15');
        $this->correios->setComprimento('19');
        $this->correios->setAltura('20');
        $this->correios->setLargura('20');
        $this->correios->setDiametro('10');

        $dadosFrete = $this->correios->calcularFrete();

        var_dump($dadosFrete);

    }

}
