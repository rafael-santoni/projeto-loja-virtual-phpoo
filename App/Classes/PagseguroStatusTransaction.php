<?php

namespace App\Classes;

use App\Models\Site\PedidosModel;
use App\Models\Site\CarrinhoModel;
use App\Classes\Estoque;
use App\Classes\Email;
use App\Interfaces\InterfaceStatusTransaction;

class PagseguroStatusTransaction implements InterfaceStatusTransaction {

    private $pedidos;
    private $email;
    private $dataPagseguro;
    private $carrinho;
    private $estoque;

    public function __construct($dataPagseguro){

        $this->dataPagseguro = $dataPagseguro;
        $this->pedidos = new PedidosModel;
        $this->email = new Email;
        $this->estoque = new Estoque;
        $this->carrinho = new CarrinhoModel;

    }

    public function aguardePagamento(){

    }

    public function pagamentoAnalise(){

    }

    public function vendaAprovada(){

    }

    public function pagamentoDisponivel(){

    }

    public function emDisputa(){
        dump($this->dataPagseguro);
    }

    public function valorDevolvido(){

    }

    public function compraCancelada(){

    }

}
