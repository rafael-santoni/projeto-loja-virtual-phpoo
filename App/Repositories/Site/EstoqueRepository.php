<?php

namespace App\Repositories\Site;

use App\Models\Site\EstoqueModel;

class EstoqueRepository {

    private $estoque;

    public function __construct(){
        $this->estoque = new EstoqueModel;
    }

    public function quantidadeProdutosEstoque($id){

        $sql = "SELECT * FROM {$this->estoque->table} WHERE estoque_produto = ?";
        $this->estoque->typeDatabase->prepare($sql);
        $this->estoque->typeDatabase->bindValue(1, $id);
        $this->estoque->typeDatabase->execute();

        return $this->estoque->typeDatabase->fetch();

    }

}
