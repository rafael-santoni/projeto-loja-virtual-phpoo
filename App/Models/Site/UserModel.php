<?php

namespace App\Models\Site;

use App\Models\Model;

class UserModel extends Model {

	public $table = "users";

	public function create(Array $attributes){

		$sql = "INSERT INTO {$this->table} (name,sobrenome,is_admin,email,password,ddd,telefone,endereco,bairro,cidade,cep,estado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
		$this->typeDatabase->prepare($sql);

		$i=1;
		foreach ($attributes as $attribute) {
			$this->typeDatabase->bindValue($i,$attribute);
			$i++;
		}

		return $this->typeDatabase->execute();

	}

}
