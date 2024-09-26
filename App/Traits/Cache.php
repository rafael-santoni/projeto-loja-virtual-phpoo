<?php

namespace App\Traits;

trait Cache{

    protected $cache;

    public function setCache($cache){
		$this->cache = $cache;
	}

}
