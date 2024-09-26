<?php

namespace App\Models\Site;

use App\Models\Model;

class UsersOnlineModel extends Model {

    public $table = 'online';

    public function create($attributes){

        $sql = "INSERT INTO {$this->table} (ip,session,expire) VALUES (?,?,?)";
        $this->typeDatabase->prepare($sql);

        $i=1;
        foreach ($attributes as $attribute) {

            $this->typeDatabase->bindValue($i, $attribute);
            $i++;

        }

        return $this->typeDatabase->execute();

    }

    public function update($expire, $session){

        // Pode pegar pela sessão ou pelo ip
        $sql = "UPDATE {$this->table} SET expire = ? WHERE session = ?";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->bindValue(1, $expire);
        $this->typeDatabase->bindValue(2, $session);
        $this->typeDatabase->execute();

        return $this->typeDatabase->rowCount();

    }

    public function remove(){

        $sql = "DELETE FROM {$this->table} WHERE NOW() > expire";
        $this->typeDatabase->prepare($sql);
        $this->typeDatabase->execute();

        return $this->typeDatabase->rowCount();

    }

}
