<?php

namespace App\Classes;

use App\Models\Site\CarrinhoBancoBackupModel;
use App\Classes\Estoque;

class RetornaEstoqueBackup {

    public function retornaEstoqueBackup($sessao){

        $estoque = new Estoque;

        // $carrinhoBancoBackupModel = new CarrinhoBancoBackupModel;
        // $produtosCarrinhoBackup = $carrinhoBancoBackupModel->find('sessao', $sessao, 'all');
        $produtosCarrinhoBackup = (new CarrinhoBancoBackupModel)->find('sessao', $sessao, 'all');
        foreach ($produtosCarrinhoBackup as $produto) {
            $estoque->atualizaEstoque($produto->produto, $estoque->estoqueAtual($produto->produto) + $produto->quantidade);
        }

    }

}
