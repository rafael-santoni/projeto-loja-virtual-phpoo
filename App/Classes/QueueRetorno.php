<?php

namespace App\Classes;

abstract class QueueRetorno {

    public static function queued($transaction){
        return (new Static)->handle($transaction);
    }

    abstract public function handle($transaction);

}
