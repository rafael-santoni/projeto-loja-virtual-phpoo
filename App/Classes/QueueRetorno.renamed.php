<?php
/*
    --*************************--
    *****   Renamed Class   *****
    *****                   *****
    *****  Esta classe foi  *****
    *****  renomeada  para  *****
    ***** QueuedRetorno.php *****
    --*************************--

namespace App\Classes;

abstract class QueueRetorno {

    public static function queue($transaction){
        return (new Static)->handle($transaction);
    }

    abstract public function handle($transaction);

}
*/