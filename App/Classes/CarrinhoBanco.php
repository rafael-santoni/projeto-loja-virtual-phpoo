<?php

namespace App\Classes;

use App\Models\Site\CarrinhoModel;

class CarrinhoBanco {

    private $carrinhoModel;

    public function __construct(){
        $this->carrinhoModel = new CarrinhoModel;
    }

    public function add($id){

        $this->carrinhoModel->add([
            1 => $id,
            2 => 1,
            3 => IdRandom(),
            4 => date('Y-m-d H:i:s'),
            5 => date('Y-m-d H:i:s', strtotime('+30minutes')),
            6 => 2
        ]);

    }

    public function update($id){
        $this->carrinhoModel->update($id, Carrinho::produtoCarrinho($id), IdRandom());
    }

    public function remove($sessao){

        $produtosCarrinho = $this->carrinhoModel->find('sessao', $sessao, 'all');
        foreach ($produtosCarrinho as $produto) {
            $this->carrinhoModel->remove($produto->produto, $produto->sessao);
        }

    }

    public function removeProduct($id, $sessao){
        $this->carrinhoModel->remove($id, $sessao);
    }

}
