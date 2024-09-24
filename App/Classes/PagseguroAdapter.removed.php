<?php
/*
    --***************************--
    *****    Removed Class    *****
    *****                     *****
    *****   Esta classe foi   *****
    ***** removida do projeto *****
    --***************************--

namespace App\Classes;

use App\Interfaces\InterfaceGerenciaStatusTransaction;

class PagseguroAdapter implements InterfaceGerenciaStatusTransaction {

    private $pagseguroStatusTransactions;

    public function __construct(PagseguroStatusTransaction $pagseguroStatusTransactions){
        $this->pagseguroStatusTransactions = $pagseguroStatusTransactions;
    }

    public function gerenciaStatus($status){

        switch ($status) {
            case '1':
                $this->pagseguroStatusTransactions->aguardePagamento();
                break;

            case '2':
                $this->pagseguroStatusTransactions->pagamentoAnalise();
                break;

            case '3':
                $this->pagseguroStatusTransactions->vendaAprovada();
                break;

            case '4':
                $this->pagseguroStatusTransactions->pagamentoDisponivel();
                break;

            case '5':
                $this->pagseguroStatusTransactions->emDisputa();
                break;

            case '6':
                $this->pagseguroStatusTransactions->valorDevolvido();
                break;

            case '7':
                $this->pagseguroStatusTransactions->compraCancelada();
                break;

        }

    }

}
*/