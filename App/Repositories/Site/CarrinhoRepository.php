<?php

namespace App\Repositories\Site;

use App\Models\Site\CarrinhoModel;

class CarrinhoRepository {

    private $carrinhoModel;

    public function __construct(){
        $this->carrinhoModel = new CarrinhoModel;
    }

    public function produtoSessao($id, $sessao){

        $sql = "SELECT * FROM {$this->carrinhoModel->table} WHERE produto = ? AND sessao = ?";
        $this->carrinhoModel->typeDatabase->prepare($sql);
        $this->carrinhoModel->typeDatabase->bindValue(1, $id);
        $this->carrinhoModel->typeDatabase->bindValue(2, $sessao);
        $this->carrinhoModel->typeDatabase->execute();

        return $this->carrinhoModel->typeDatabase->fetch();

    }

    public function updateStatus($sessao){

        $sql = "UPDATE {$this->carrinhoModel->table} SET status = ? WHERE sessao = ?";
        $this->carrinhoModel->typeDatabase->prepare($sql);
        $this->carrinhoModel->typeDatabase->bindValue(1, 1);
        $this->carrinhoModel->typeDatabase->bindValue(2, $sessao);
        $this->carrinhoModel->typeDatabase->execute();

        return $this->carrinhoModel->typeDatabase->rowCount();

    }

}
