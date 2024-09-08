<?php

namespace App\Repositories\Site;

use App\Models\Site\CategoriaModel;

class CategoriaRepository {

	private $categoria;

	public function __construct(){
		$this->categoria = new CategoriaModel;
	}

	// public function listarCategoriasProdutos(){
	// 	// $sql = "SELECT * FROM {$this->categoria->table} INNER JOIN produtos ON (categorias.id = produtos.produto_categoria) GROUP BY categorias.id";
	// 	$sql = "SELECT categoria_slug,categoria_nome FROM {$this->categoria->table} GROUP BY categorias.id";
	// 	$this->categoria->typeDatabase->prepare($sql);
	// 	$this->categoria->typeDatabase->execute();
	// 	return $this->categoria->typeDatabase->fetchAll();
	// }
	
}