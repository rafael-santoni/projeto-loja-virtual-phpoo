<?php

namespace App\Models\Site;

use App\Models\Model;

class EstoqueModel extends Model {

    public $table = 'estoque';

    public function update($id, $qtd){

        $sql = "UPDATE {$this->table} SET estoque_quantidade = ? WHERE estoque_produto = ?";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->bindValue(1, $qtd);
        $this->typeDatabase->bindValue(2, $id);

        return $this->typeDatabase->execute();

    }

}
