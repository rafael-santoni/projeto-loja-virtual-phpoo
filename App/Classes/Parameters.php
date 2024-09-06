<?php

namespace App\Classes;

class Parameters {

	private $uri;
	private $parameter;

	public function __construct(){

		$uri = new Uri;
		$this->uri = $uri->getUri();

	}

	private function explodeParameters(){

		$explodeUri = explode('/', $this->uri);
		$this->parameter = array_filter($explodeUri);

	}

	public function getParameterMethod($object, $method){
		
		if(method_exists($object, $method)){
			$this->explodeParameters();

			if($method == 'index'){
				return isset($this->parameter[2]) ? $this->parameter[2] : null;
			}

			return isset($this->parameter[3]) ? $this->parameter[3] : null;
		}

	}

}