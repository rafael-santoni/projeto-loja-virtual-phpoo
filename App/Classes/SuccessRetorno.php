<?php

namespace App\Classes;

use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Classes\QueueRetorno;
use App\Classes\CarrinhoBanco;
use App\Classes\CarrinhoBancoBackup;
use App\Classes\Pedidos;

class SuccessRetorno extends QueueRetorno {

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

    private function handle($transaction){

        $this->carrinhoBackup($transaction);
        $this->carrinhoBanco($transaction);
        $this->pedidos($transaction);

    }

}
