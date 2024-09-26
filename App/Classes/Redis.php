<?php

namespace App\Classes;

use App\Interfaces\InterfaceCache;

class Redis implements InterfaceCache {

    private $redis;
    private const TIME_EXPIRE = '+1day';

    public function __construct($redis){
        $this->redis = $redis;
    }

    public function set($key, $value){
        $this->redis->set($key, json_encode($value));
    }

    public function get($key){
        return json_decode($this->redis->get($key));
    }

    public function expire($key){
        return $this->redis->expireat($key, strtotime(self::TIME_EXPIRE));
    }

    public function incr($key){
        return $this->redis->incr($key);
    }

}
