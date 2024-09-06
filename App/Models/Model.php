<?php

namespace App\Models;

use App\Models\Database\TypeDatabase\TypePdoDatabase;
use App\Models\Database\TypeDatabase\TypeMysqliDatabase;
use App\Models\Database\TypeDatabase\TypeDatabase;

class Model {

	private $typeDatabase;

	public function __construct(){

		$database = new TypeDatabase(new TypePdoDatabase);
		$this->typeDatabase = $database->getDatabase();

	}

	public function fetchAll(){
		
	}

	public function find(){
		
	}

}