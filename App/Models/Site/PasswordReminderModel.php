<?php

namespace App\Models\Site;

use App\Models\Model;

class PasswordReminderModel extends Model {

    public $table = 'password_reminder';

    public function create(array $attributes){

        $sql = "INSERT INTO {$this->table} (user,created_at,expire,hash) VALUES (?,?,?,?)";
        $this->typeDatabase->prepare($sql);

        $i = 1;
        foreach ($attributes as $attribute) {
            $this->typeDatabase->bindValue($i, $attribute);
            $i++;
        }

        return $this->typeDatabase->execute();

    }

}
