<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;

class ProdutoController extends BaseController {

	public function index($parameters){
		echo '<pre>'; print_r($parameters[2]); echo '</pre>'; exit();
	}

	public function calca($parameters){
		echo '<pre>'; print_r($parameters[2]); echo '</pre>'; exit();
	}
	
}