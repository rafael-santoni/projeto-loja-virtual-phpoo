<?php

namespace App\Interfaces;

interface InterfaceStatusTransaction {

    public function aguardePagamento();
    public function pagamentoAnalise();
    public function vendaAprovada();
    public function pagamentoDisponivel();
    public function emDisputa();
    public function valorDevolvido();
    public function compraCancelada();

}
