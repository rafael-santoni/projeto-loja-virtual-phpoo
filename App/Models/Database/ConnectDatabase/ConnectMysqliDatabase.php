<?php

namespace App\Models\Database\ConnectDatabase;

use App\Interfaces\InterfaceConnectDatabase;
use Mysqli;

class ConnectMysqliDatabase implements InterfaceConnectDatabase {

	private $mysqli;

	public function __construct(){
		$this->mysqli = new Mysqli("localhost:3307","conn","ADMonly","loja_phpoo");
	}

	public function connectDatabase(){
		return $this->mysqli;
	}

}