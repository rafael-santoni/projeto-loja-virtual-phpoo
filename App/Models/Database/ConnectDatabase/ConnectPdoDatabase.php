<?php

namespace App\Models\Database\ConnectDatabase;

use App\Interfaces\InterfaceConnectDatabase;
use PDO;

class ConnectPdoDatabase implements InterfaceConnectDatabase {

	private $pdo;

	public function __construct(){
		$this->pdo = new PDO("mysql:host=localhost;port=3307;dbname=loja_phpoo","conn","ADMonly");
		$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function connectDatabase(){
		return $this->pdo;
	}

}