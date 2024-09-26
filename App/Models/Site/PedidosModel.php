<?php

namespace App\Models\Site;

use App\Models\Model;

class PedidosModel extends Model{

    public $table = 'pedidos';

    public function create($attributes){

        $sql = "INSERT INTO {$this->table} (pedido_user,created_at,pedido_frete,pedido_status,sessao,total,status_pagamento) VALUES (?,?,?,?,?,?,?)";
        $this->typeDatabase->prepare($sql);

        $i = 1;
        foreach ($attributes as $attribute) {

            $this->typeDatabase->bindValue($i, $attribute);
            $i++;

        }

        return $this->typeDatabase->execute();

    }

    public function update($sessao, $statusPagamento, $status){

        $sql = "UPDATE {$this->table} SET pedido_status = ?, status_pagamento = ? WHERE sessao = ?";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->bindValue(1, $status);
        $this->typeDatabase->bindValue(2, $statusPagamento);
        $this->typeDatabase->bindValue(3, $sessao);
        $this->typeDatabase->execute();

        return $this->typeDatabase->rowCount();

    }
}
