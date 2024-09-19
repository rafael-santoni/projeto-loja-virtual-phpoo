<?php

namespace App\Traits;

trait ErrorsCheckoutValidate {

    public function error($error){

        echo json_encode($error);
        die();

    }

}
