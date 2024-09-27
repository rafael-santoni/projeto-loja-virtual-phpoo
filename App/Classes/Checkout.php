<?php

namespace App\Classes;

use App\Interfaces\InterfacePayment;
use App\Classes\Carrinho;
use App\Classes\CarrinhoBanco;
use App\Classes\Frete;
use App\Classes\IdRandom;

class Checkout {

    public function checkoutAndPayment(array $data, InterfacePayment $payment){

        $returnPayment = $payment->dataAndPayment($data);

        $this->atualizaStatusCarrinho();
        $this->limparCarrinho();

        return $returnPayment;

    }

    private function limparCarrinho(){

        Carrinho::clear();
        IdRandom::clear();
        Frete::limparFrete();

    }

    private function atualizaStatusCarrinho(){

        $carrinhoBanco = new CarrinhoBanco;
        $carrinhoBanco->updateStatus(IdRandom());

    }

}
