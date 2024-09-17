<?php

namespace App\Classes;

use App\Models\Site\PedidosModel;
use App\Models\Site\PedidosProdutosModel;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class Pedidos {

    private $pedidos;
    private $pedidosProdutos;
    private $produtosCarrinho;

    public function __construct(){

        $this->pedidos = new PedidosModel;
        $this->pedidosProdutos = new PedidosProdutosModel;
        $this->produtosCarrinho = new ProdutosCarrinhoRepository;

    }

    private function cadastroPedidos($sessao){

        $pedidosCadastrado = false;
        foreach ($this->produtosCarrinho as $produto) {

            $attributes = [
                $produto['produtos']->id,
                $produto['valor'],
                $produto['qtd'],
                $sessao,
                $_SESSION['id'],
                $produto['subtotal']
            ];

            if($this->pedidosProdutos->create($attributes)){
                $pedidosCadastrado = true;
            }

        }

        return $pedidosCadastrado;

    }

    private function cadastroPedido($sessao){

        $pedidoCadastrado = false;
        if($this->pedidos->create([
                                $_SESSION['id'], date('Y-m-d H:i:s'), $frete->pegarFrete(),
                                2, $sessao, $this->produtosCarrinho->totalProdutosCarrinho()
                            ])) {
            $pedidoCadastrado = true;
        }

        return $pedidoCadastrado;

    }

    public function create($sessao){

        $cadastroPedido = $this->cadastroPedido($sessao);
        $cadastroPedidos = $this->cadastroPedidos($sessao);

        return (!$cadastroPedido || !$cadastroPedidos) ? false : true;

    }

    public function remove($sessao){

        $this->pedidos->delete('sessao', $sessao);
        $this->pedidosProdutos->delete('sessao', $sessao);

    }

    public function update($sessao, $status){

        $this->pedidos->update($sessao, $status);

    }

}
