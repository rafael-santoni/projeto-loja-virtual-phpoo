<?php

namespace App\Classes;

use App\Interfaces\InterfacePayment;
use App\Repositories\ProdutosCarrinhoRepository;
use App\Classes\Frete;

class Pagseguro implements InterfacePayment {

    // private $nome;
    // private $sobrenome;
    // private $email;
    // private $ddd;
    // private $telefone;
    // private $idReferencia;
    // private $credenciais;
    // private $itemAdd = [];
    private $pagseguroConfig;
    //
    // public function setNome($nome) {
    //     $this->nome = $nome;
    // }
    //
    // public function setSobreNome($sobrenome) {
    //     $this->sobrenome = $sobrenome;
    // }
    //
    // public function setEmail($email) {
    //     $this->email = $email;
    // }
    //
    // public function setDdd($ddd) {
    //     $this->ddd = $ddd;
    // }
    //
    // public function setTelefone($telefone) {
    //     $this->telefone = $telefone;
    // }
    //
    // public function setIdReferencia($idReference) {
    //     $this->idReferencia = $idReference;
    // }
    //
    // public function setItemAdd($itemAdd) {
    //     $this->itemAdd = $itemAdd;
    // }

    public function __construct(){

        $this->pagseguroConfig = new \PagSeguroPaymentRequest;
        \PagSeguroLibrary::init();

    }

    private function produtosEFrete(){

        $produtosCarrinho = new ProdutosCarrinhoRepository;
        $produtosNoCarrinho = $produtosCarrinho->produtos;

        array_push($produtosNoCarrinho, Frete::formatFreteToObject());

        return $produtosNoCarrinho;

    }

    private function config($data){

        $this->pagseguroConfig->setSender(
            $data['name'].' '.$data['sobrenome'],
            $data['email'],
            $data['ddd'],
            $data['telefone'],
        );

        $this->pagseguroConfig->setReference($data['idReferencia']);
        $this->pagseguroConfig->setShippingAddress(null);
        $this->pagseguroConfig->setCurrency('BRL');

        foreach ($this->produtosEFrete() as $produto) {

            $this->pagseguroConfig->addItem(
                $produto['produtos']->id,
                $produto['produtos']->produto_nome,
                $produto['qtd'],
                $produto['valor']
            );

        }

    }

    // private function dadosCompra(){
    //
    //     $this->pagseguroConfig->setSender($this->nome.' '.$this->sobrenome,$this->email,$this->ddd,$this->telefone);
    //     $this->pagseguroConfig->setReference($this->idReferencia);
    //     $this->pagseguroConfig->setShippingAddress('cep','rua','numero','complemento','bairro','cidade','estado','pais');
    //     $this->pagseguroConfig->setShippingAddress(null);
    //     $this->pagseguroConfig->setCurrency('BRL');
    //
    //     foreach ($this->itemAdd as $item) {
    //
    //         $this->pagseguroConfig->addItem(
    //             $item['produtos']->id,
    //             $item['produtos']->produto_nome,
    //             $item['qtd'],
    //             $item['valor']
    //         );
    //
    //     }
    //
    // }

    // public function enviarPagseguro(){
    //
    //     $this->dadosCompra();
    //     $this->credenciais = new \PagSeguroAccountCredentials(
    //         'xandecar@hotmail.com',
    //         'FF579CC8863549A783664FDC85657678'
    //     );
    //
    //     return $this->pagseguroConfig->register($this->credenciais);
    //
    // }

    public function dataPayment($data){

        $this->config($data);
        return $this;

    }

    public function pay(){

        $credenciais = new \PagSeguroAccountCredentials(
            'xandecar@hotmail.com',
            'FF579CC8863549A783664FDC85657678'
        );

        return $this->pagseguroConfig->register($credenciais);

    }

}
