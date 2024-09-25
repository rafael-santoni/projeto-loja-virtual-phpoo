<?php

namespace App\Classes;

use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Classes\QueuedRetorno;
use App\Classes\CarrinhoBancoBackup;
use App\Classes\RetornaEstoqueBackup;
use App\Classes\Pedidos;

class ErrorRetorno extends QueuedRetorno {

    private function carrinhoBancoBackup($transaction){

        $carrinhoBancoBackup = new CarrinhoBancoBackup;
        $carrinhoBancoBackup->remove($transaction->reference);

    }

    private function retornaEstoqueBackup($transaction){

        $retornaEstoqueBackup = new RetornaEstoqueBackup;
        $retornaEstoqueBackup->retornaEstoqueBackup($transaction->reference);

    }

    private function pedidos($transaction){

        $pedidos = new Pedidos(new ProdutosCarrinhoRepository);
        $pedidos->remove($transaction->reference);

    }

    public function handle($transaction){

        // retornar o produto para o estoque
        $this->retornaEstoqueBackup($transaction);

        // remover o carrinho_backup
        $this->carrinhoBancoBackup($transaction);

        // remover o pedido
        $this->pedidos($transaction);

    }

}
