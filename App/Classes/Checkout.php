<?php

namespace App\Classes;

use App\Interfaces\InterfacePayment;
use App\Classes\Carrinho;
use App\Classes\CarrinhoBanco;

class Checkout {

    public function checkoutAndPayment(array $data, InterfacePayment $payment){

        $returnPayment = $payment->dataPayment($data)->pay();

        $this->atualizaStatusCarrinho();
        $this->limparCarrinho();

        return $returnPayment;

    }

    private function limparCarrinho(){

        Carrinho::clear();
        IdRandom::clear();

    }

    private function atualizaStatusCarrinho(){

        $carrinhoBanco = new CarrinhoBanco;
        $carrinhoBanco->updateStatus(IdRandom());

    }

}
