<?php

namespace App\Controllers;

use App\Traits\Twig;
use App\Traits\Cache;

class BaseController {

	use Twig, Cache;

	// protected $twig;
	// protected $cache;
	//
	// public function setTwig($twig){
	// 	$this->twig = $twig;
	// }
	//
	// public function setCache($cache){
	// 	$this->cache = $cache;
	// }

}
