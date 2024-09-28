<?php

namespace App\Classes;

use App\Classes\Uri;

class BreadCrumb {

	private $uri;

	public function __construct(){

		$uri = new Uri;
		$this->uri = $uri->getUri();

	}

	private function breadCrumbHome(){
		return '<span style="color: #000;">Navegação</span>: <span style="font-style:italic; color:blue;">Início</span>';
	}

	private function breadCrumbRedefinirSenha(){

		$explode = explode('/', $this->uri);
		$filterExplode = array_filter($explode);

		if((isset($filterExplode[1]) && $filterExplode[1]=='esqueci') && (isset($filterExplode[2]) && $filterExplode[2]=='senha')) {
			return true;
		}

		return false;

	}

	private function breadCrumbOtherPages(){

		if($this->breadCrumbRedefinirSenha()) {
			return '<span style="color: #000;">Navegação</span>: <span style="font-style:italic; color:blue;"> <a href="/" style="text-decoration:none;color:blue;">Início</a>/esqueci/senha</span>';
		}

		return '<span style="color: #000;">Navegação</span>: <span style="font-style:italic; color:blue;"> <a href="/" style="text-decoration:none;color:blue;">Início</a>/'.ltrim($this->uri,'/').'</span>';

	}

	private function breadCrumbSearch(){

		$explodeIgual = explode('=', $this->uri);

		return '<span style="color: #000;">Você está buscando:</span> <span style="font-style:italic; color:blue;">'.str_replace('+', '-', $explodeIgual[1]).'</span>';

	}

	public function createBreadCrumb(){

		// Bread crumb para a página inicial
		if($this->uri == '/') {
			return $this->breadCrumbHome();
		}

		// Bread crumb para a busca
		if(substr_count($this->uri, '?') > 0) {
			return $this->breadCrumbSearch();
		}

		// Bread crumb para ouyras páginas internas do site
		return $this->breadCrumbOtherPages();

	}

}
