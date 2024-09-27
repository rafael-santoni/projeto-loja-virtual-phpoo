<?php

namespace App\Repositories\Site;

use App\Models\Site\PedidosProdutosModel;
use App\Models\Site\ProdutoModel;

class PedidosProdutosRepository {

    private $pedidos;

    public function __construct(){
        $this->pedidos = new PedidosProdutosModel;
    }

    public function pedidos($user, $sessao){

        $sql = "SELECT produto, quantidade, valor, subtotal FROM pedidos_produtos WHERE pedidos_produtos.user = ? AND pedidos_produtos.sessao = ?";
        $this->pedidos->typeDatabase->prepare($sql);
        $this->pedidos->typeDatabase->bindValue(1, $user);
        $this->pedidos->typeDatabase->bindValue(2, $sessao);
        $this->pedidos->typeDatabase->execute();

        return $this->pedidos->typeDatabase->fetchAll();

    }

    public function produtosPedido($pedidos){

        $produtoModel = new ProdutoModel;

        $produtos = [];
        foreach ($pedidos as $pedido) {

            $produtoPedido = $produtoModel->find('id', $pedido->produto);

            $produtos[] = [
                'produtos' => $produtoPedido,
                'subtotal' => $pedido->subtotal,
                'qtd' => $pedido->quantidade,
                'valor' => $pedido->valor
            ];

        }

        return $produtos;

    }

}
