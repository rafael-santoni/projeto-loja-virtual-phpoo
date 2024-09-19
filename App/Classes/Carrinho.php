<?php

namespace App\Classes;

use App\Classes\StatusCarrinho;

class Carrinho {

    public function __construct(){
        StatusCarrinho::criarCarrinho();
    }

    public static function add($id){
        $_SESSION['carrinho'][$id] = 1;
    }

    public static function addOneMore($id){
        $_SESSION['carrinho'][$id] += 1;
    }

    public static function produtoCarrinho($id){
        return $_SESSION['carrinho'][$id];
    }

    public static function update($id, $qtd){
        $_SESSION['carrinho'][$id] = $qtd;
    }

    public static function remove($id){
        unset($_SESSION['carrinho'][$id]);
    }

    public static function clear(){

        if(StatusCarrinho::carrinhoExiste()) {
            unset($_SESSION['carrinho']);
        }

    }

    public static function produtosCarrinho(){

        if(StatusCarrinho::carrinhoExiste()) {
            return StatusCarrinho::carrinho();
        }

    }

}
