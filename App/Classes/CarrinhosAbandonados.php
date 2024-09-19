<?php

namespace App\Classes;

use App\Models\Site\CarrinhoModel;
use App\Classes\Carrinho;
use App\Classes\CarrinhoBanco;
use App\Classes\RetornaEstoque;

class CarrinhosAbandonados {

    private function carrinhosAbandonados(){

        $carrinhoModel = new CarrinhoModel;
        return $carrinhoModel->carrinhosAbandonados();

    }

    private function removeProducts($retornaEstoque){

        $carrinhoBanco = new CarrinhoBanco;

        foreach ($this->carrinhosAbandonados() as $produto) {

            $retornaEstoque->retornaProdutoEstoque($produto->produto, $produto->sessao);

            $carrinhoBanco->removeProduct($produto->produto, $produto->sessao);
            Carrinho::remove($produto->produto);

        }

    }

    public static function remove(RetornaEstoque $retornaEstoque){
        return (new Self)->removeProducts($retornaEstoque);
    }

}
