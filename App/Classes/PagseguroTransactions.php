<?php

namespace App\Classes;

use App\Interfaces\InterfaceEmailPayment;
use App\Classes\SuccessRetorno;
use App\Classes\ErrorRetorno;

class PagseguroTransactions {

    private $transactions;
    private $email;

    public function __construct($transactions, InterfaceEmailPayment $email){

        $this->transactions = $transactions;
        $this->email = $email;

    }

    public function aguardePagamento(){

        // Enviar email de Aguarde Pagamento para o comprador
        $this->email->aguardePagamento();

    }

    public function pagamentoAnalise(){

        // Enviar email de Pagamento em Análise para o comprador
        $this->email->pagamentoAnalise();

    }

    public function vendaAprovada(){

        // Enviar email de Venda Aprovada para o comprador
        $this->email->vendaAprovada();

        // Executar rotina de Venda Aprovada
        SuccessRetorno::run($this->transactions);
        dump('SuccessRetorno->OK, Venda Aprovada!!');

    }

    public function pagamentoDisponivel(){

        // Enviar email de Venda Aprovada para o Administrador
        $this->email->pagamentoDisponivel();

    }

    public function emDisputa(){

        // Enviar email de Em Disputa para o comprador e o Administrador
        $this->email->emDisputa();

    }

    public function valorDevolvido(){

        // Enviar email de Em Disputa para o comprador e o Administrador
        $this->email->valorDevolvido();

        // Executar rotina de Valor Devolvido
        ErrorRetorno::run($this->transactions);
        dump('ErrorRetorno->OK, Compra Cancelada!!');

    }

    public function compraCancelada(){

        // Enviar email de Em Disputa para o comprador e o Administrador
        $this->email->compraCancelada();

        // Executar rotina de Compra Cancelada
        ErrorRetorno::run($this->transactions);
        dump('ErrorRetorno->OK, Compra Cancelada!!');

    }

}
