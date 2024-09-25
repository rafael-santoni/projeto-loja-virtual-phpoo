<?php

namespace App\Classes;

use App\Models\Site\CarrinhoModel;
use App\Models\Site\CarrinhoBancoBackupModel;

class CarrinhoBancoBackup {

    private $carrinhoBancoBackupModel;

    public function __construct(){
        $this->carrinhoBancoBackupModel = new CarrinhoBancoBackupModel;
    }

    public function add($sessao){

        $carrinhoModel = new CarrinhoModel;
        $produtosCarrinho = $carrinhoModel->find('sessao', $sessao, 'all');

        foreach ($produtosCarrinho as $produto) {
            $this->carrinhoBancoBackupModel->add($produto->produto, $produto->quantidade, $produto->sessao);
        }

    }

    public function remove($sessao){

        $produtosCarrinhoBackup = $this->carrinhoBancoBackupModel->find('sessao', $sessao, 'all');
        foreach ($produtosCarrinhoBackup as $produto) {
            $this->carrinhoBancoBackupModel->remove($produto->produto, $produto->sessao);
        }

    }

}
