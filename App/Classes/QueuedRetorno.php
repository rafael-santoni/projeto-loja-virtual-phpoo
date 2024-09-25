<?php

namespace App\Classes;

abstract class QueuedRetorno {

    public static function run($transaction){
        return (new Static)->handle($transaction);
    }

    abstract public function handle($transaction);

}
