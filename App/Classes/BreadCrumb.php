<?php

namespace App\Classes;

use App\Classes\Uri;

class BreadCrumb {

	private $uri;

	public function __construct(){

		$uri = new Uri;
		$this->uri = $uri->getUri();
		
	}

	public function createBreadCrumb(){

		// Bread crumb para a busca
		if(substr_count($this->uri, '?') > 0) {
			$explodeIgual = explode('=', $this->uri);

			return '<span style="color: #000;">Você está buscando:</span>
					<span style="font-style=italic;color:blue;"><a href="/" style="text-decoration:none;color:blue;">Início</a>/'.str_replace('+', '-', $explodeIgual[1].'</span>');
		}

		// Bread crumb para a página inicial
		if($this->uri == '/'){
			return '<span style="color: #000;">Navegação</span>: <span style="font-style=italic;color:blue;">Início</span>';
		}

		// Bread crumb para ouyras páginas internas do site
		return '<span style="color: #000;">Navegação</span>:
				<span style="font-style=italic; color:blue;"> <a href="/" style="text-decoration:none;color:blue;">Início</a>/'.ltrim($this->uri,'/').'</span>';
		
	}

}