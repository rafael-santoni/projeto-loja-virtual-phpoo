<?php

namespace App\Classes;

abstract class QueuedOperations {

    public static function queued(){
        return (new Static)->handle();
    }

    abstract public function handle();

}
