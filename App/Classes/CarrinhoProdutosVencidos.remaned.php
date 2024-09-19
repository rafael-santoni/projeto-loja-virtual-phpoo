<?php
/*
    --*******************************--
    *****    Deprecated Class     *****
    *****    Esta classe foi      *****
    *****     renomeada para      *****
    ***** CarrinhosAbandonados.php ****
    --*******************************--

namespace App\Classes;

use App\Models\Site\CarrinhoModel;
use App\Classes\Carrinho;

class CarrinhoProdutosVencidos {

    public function verificarProdutosVencidosCarrinho(){

        $carrinhoModel = new CarrinhoModel;
        $carrinho = new Carrinho;

        $produtosVencidos = $carrinhoModel->produtosVencidos();

        foreach ($produtosVencidos as $produto) {

            $carrinhoModel->remove($produto->produto);
            $carrinho->remove($produto->produto);

        }

    }

}
*/