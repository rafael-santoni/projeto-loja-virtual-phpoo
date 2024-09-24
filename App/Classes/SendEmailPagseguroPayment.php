<?php

namespace App\Classes;

use App\Interfaces\InterfaceEmailPayment;
use App\Classes\SendEmail;
use App\Classes\TemplateAguardePagamento;
use App\Classes\TemplateVendaAprovada;

class SendEmailPagseguroPayment implements InterfaceEmailPayment {

    private $sendEmail;
    private $transaction;

    public function __construct($transaction){

        $this->sendEmail = new SendEmail;
        $this->transaction = $transaction;
    }

    public function aguardePagamento(){

        $this->sendEmail->setMensagem([
            'nome' => $this->transaction->sender->name
        ]);
        $this->sendEmail->send([
            $this->transaction->sender->email,
            'Loja Virtual - RS-Dev',
            'Aguarde Pagamento'
        ], new TemplateAguardePagamento);

    }

    public function pagamentoAnalise(){

    }

    public function vendaAprovada(){

        $this->sendEmail->setMensagem([
            'nome' => $this->transaction->sender->name
        ]);
        $this->sendEmail->send([
            $this->transaction->sender->email,
            'Loja Virtual - RS-Dev',
            'Venda Aprovada'
        ], new TemplateVendaAprovada);

    }

    public function pagamentoDisponivel(){

    }

    public function emDisputa(){

    }

    public function valorDevolvido(){

    }

    public function compraCancelada(){

    }

}
