<?php

namespace App\Repositories\Site;

use App\Models\Site\ProdutoModel;

class ProdutoRepository {

	private $produto;

	public function __construct(){
		$this->produto = new ProdutoModel;
	}

	// Listar o último produto adicionado
	public function ultimoProdutoAdicionado(){

		$sql = "SELECT produto_nome,produto_slug,produto_foto,produto_promocao,produto_valor,produto_valor_promocao FROM {$this->produto->table} ORDER BY id DESC";
		$this->produto->typeDatabase->prepare($sql);
		$this->produto->typeDatabase->execute();

		return $this->produto->typeDatabase->fetch();
		
	}

	// Listar os produtos em destaque
	public function listarProdutosOrdenadosPeloDestaque($limite){

		$sql = "SELECT * FROM {$this->produto->table} ORDER BY produto_destaque=1 DESC LIMIT {$limite}";
		$this->produto->typeDatabase->prepare($sql);
		$this->produto->typeDatabase->execute();

		return $this->produto->typeDatabase->fetchAll();
		
	}

	// Listar os produtos em promoção
	public function listarProdutosPromocao($limite){

		$sql = "SELECT * FROM {$this->produto->table} WHERE produto_promocao=1 ORDER BY produto_destaque=1 DESC LIMIT {$limite}";
		$this->produto->typeDatabase->prepare($sql);
		$this->produto->typeDatabase->execute();

		return $this->produto->typeDatabase->fetchAll();
		
	}

}