<?php

namespace App\Models\Site;

use App\Models\Model;

class CarrinhoBancoBackupModel extends Model {

    public $table = 'carrinho_backup';

    public function add($produto, $quantidade, $sessao){

        $sql = "INSERT INTO {$this->table} (produto, quantidade, sessao) VALUES (?,?,?)";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->bindValue(1, $produto);
        $this->typeDatabase->bindValue(2, $quantidade);
        $this->typeDatabase->bindValue(3, $sessao);

        return $this->typeDatabase->execute();

    }

    public function remove($id, $sessao){

        $sql = "DELETE FROM {$this->table} WHERE produto = ? AND sessao = ?";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->bindValue(1, $id);
        $this->typeDatabase->bindValue(2, $sessao);

        return $this->typeDatabase->execute();

    }

}
