<?php

namespace App\Controllers;

class BaseController {

	protected $tiwg;

	public function setTwig($twig){
		$this->twig = $twig;
	}

}