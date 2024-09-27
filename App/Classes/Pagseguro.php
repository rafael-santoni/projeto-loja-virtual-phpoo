<?php

namespace App\Classes;

use App\Interfaces\InterfacePayment;
use App\Repositories\Site\ProdutosCarrinhoRepository;
use App\Classes\Frete;
use App\Classes\PagseguroCurl;

class Pagseguro implements InterfacePayment {


    private function produtosEFrete(){

        $produtosCarrinho = new ProdutosCarrinhoRepository;
        $produtosNoCarrinho = $produtosCarrinho->produtosNoCarrinho();

        array_push($produtosNoCarrinho, Frete::formatFreteToObject());

        return $produtosNoCarrinho;

    }

    private function config($data){

        $dadosUser = $data[0];

        $pagseguroData = [];
        $pagseguroData['email'] = 'xandecar@hotmail.com';
        $pagseguroData['token'] = 'FF579CC8863549A783664FDC85657678';
        $pagseguroData['reference'] = $data['idReferencia'];
        $pagseguroData['currency'] = 'BRL';
        $pagseguroData['senderName'] = $dadosUser->name.' '.$dadosUser->sobrenome;
        $pagseguroData['senderAreaCode'] = $dadosUser->ddd;
        $pagseguroData['senderPhone'] = $dadosUser->telefone;
        $pagseguroData['senderEmail'] = $dadosUser->email;
        $pagseguroData['shippingType'] = 3;
        $pagseguroData['shippingAddressStreet'] = $dadosUser->endereco;
        $pagseguroData['shippingAddressNumber'] = 140;
        $pagseguroData['shippingAddressComplement'] = 'Complemento';
        $pagseguroData['shippingAddressDistrict'] = $dadosUser->bairro;
        $pagseguroData['shippingAddressPostalCode'] = $dadosUser->cep;
        $pagseguroData['shippingAddressCity'] = $dadosUser->cidade;
        $pagseguroData['shippingAddressState'] = strtoupper($dadosUser->estado);
        $pagseguroData['shippingAddressCountry'] = 'BRA';

        $i=1;
        foreach ($this->produtosEFrete() as $produto) {

            $pagseguroData['itemId'.$i] = $produto['produtos']->id;
            $pagseguroData['itemDescription'.$i] = $produto['produtos']->produto_nome;
            $pagseguroData['itemAmount'.$i] = number_format($produto['valor'],2, '.', '');
            $pagseguroData['itemQuantity'.$i] = $produto['qtd'];

            $i++;

        }

        $query = http_build_query($pagseguroData);

        // $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/?email=suporte@lojamodelo.com.br&token=57BE455F4EC148E5A54D9BB91C5AC12C";
        $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/?email=xandecar@hotmail.com&token=FF579CC8863549A783664FDC85657678";

        return (new PagseguroCurl)->get($url, $query);

    }

    public function dataAndPayment($data){
        return $this->config($data);
    }



}
