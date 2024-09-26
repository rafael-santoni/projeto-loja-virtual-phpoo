<?php

namespace App\Classes;

use App\Interfaces\InterfaceCache;

class Cache {

    private $cache;

    public function __construct(InterfaceCache $cache){
        $this->cache = $cache;
    }

    public function set($key, $value){
        $this->cache->set($key, $value);
    }

    public function get($key){
        return $this->cache->get($key);
    }

    public function expire($key){
        $this->cache->expire($key);
    }

    public function incr($key){
        $this->cache->incr($key);
    }

}
