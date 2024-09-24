<?php

namespace App\Classes;

use App\Interfaces\InterfaceEmailPayment;

class PagseguroTransactions {

    private $transactions;
    private $email;

    public function __construct($transactions, InterfaceEmailPayment $email){

        $this->transactions = $transactions;
        $this->email = $email;

    }

    public function aguardePagamento(){
        $this->email->aguardePagamento();
    }

    public function pagamentoAnalise(){
        $this->email->pagamentoAnalise();
    }

    public function vendaAprovada(){
        $this->email->vendaAprovada();
    }

    public function pagamentoDisponivel(){
        $this->email->pagamentoDisponivel();
    }

    public function emDisputa(){
        $this->email->emDisputa();
    }

    public function valorDevolvido(){
        $this->email->valorDevolvido();
    }

    public function compraCancelada(){
        $this->email->compraCancelada();
    }

}
