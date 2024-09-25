<?php

namespace App\Classes;

use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Classes\QueuedRetorno;
use App\Classes\CarrinhoBanco;
use App\Classes\CarrinhoBancoBackup;
use App\Classes\Pedidos;

class SuccessRetorno extends QueuedRetorno {

    private function carrinhoBackup($transaction){

        $carrinhoBackup = new CarrinhoBancoBackup;
        $carrinhoBackup->add($transaction->reference);

    }

    private function carrinhoBanco($transaction){

        $carrinhoBanco = new CarrinhoBanco;
        $carrinhoBanco->remove($transaction->reference);

    }

    private function pedidos($transaction){

        $pedidos = new Pedidos(new ProdutosCarrinhoRepository);
        $pedidos->update($transaction->reference, $transaction->status, 1);

    }

    public function handle($transaction){

        // Adicionar produto ao carrinho_backup
        $this->carrinhoBackup($transaction);

        // Deletar os produtos do carrinho
        $this->carrinhoBanco($transaction);

        // Update dos pedidos
        $this->pedidos($transaction);

    }

}
