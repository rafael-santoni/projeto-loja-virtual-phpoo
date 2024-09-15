<?php

namespace App\Models\Site;

use App\Models\Model;

class PedidosModel extends Model{

    public $table = 'pedidos';

    public function create($attributes){

        $sql = "INSERT INTO {$this->table} (pedido_user,created_at,pedido_frete,pedido_status,sessao) VALUES (?,?,?,?,?)";
        $this->typeDatabase->prepare($sql);

        $i = 1;
        foreach ($attributes as $attribute) {

            $this->typeDatabase->bindValue($i, $attribute);
            $i++;

        }

        return $this->typeDatabase->execute();

    }
}
