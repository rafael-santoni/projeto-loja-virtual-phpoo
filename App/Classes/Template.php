<?php

namespace App\Classes;

class Template {

	public function loader(){
		return new \Twig_Loader_Filesystem(['../App/Views/Site','../App/Views/Admin']);
	}

	public function init(){
		return new \Twig_Environment($this->loader(), [
			'debug' => true,
			// 'cache' => ''
			'auto_reload' => true
		]);

	}

}