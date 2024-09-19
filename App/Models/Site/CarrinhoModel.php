<?php

namespace App\Models\Site;

use App\Models\Model;

class CarrinhoModel extends Model {

    public $table = 'carrinho';

    public function add(Array $attributes){

        $sql = "INSERT INTO {$this->table} (produto,quantidade,sessao,created_at,expire,status) VALUES (?,?,?,?,?,?)";
        $this->typeDatabase->prepare($sql);

        foreach ($attributes as $key=>$value) {
            $this->typeDatabase->bindValue($key,$value);
        }

        return $this->typeDatabase->execute();

    }

    public function update($id, $qtd, $sessao){

        $sql = "UPDATE {$this->table} SET quantidade = ? WHERE produto = ? AND sessao = ?";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->bindValue(1, $qtd);
        $this->typeDatabase->bindValue(2, $id);
        $this->typeDatabase->bindValue(3, $sessao);
        $this->typeDatabase->execute();

        return $this->typeDatabase->rowCount();

    }

    public function remove($id, $sessao){

        $sql = "DELETE FROM {$this->table} WHERE produto = ? AND sessao = ?";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->bindValue(1, $id);
        $this->typeDatabase->bindValue(2, $sessao);

        return $this->typeDatabase->execute();

    }

    public function carrinhosAbandonados(){

        $sql = "SELECT * FROM {$this->table} WHERE NOW() > expire AND status = 2";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->execute();

        return $this->typeDatabase->fetchAll();

    }

}
