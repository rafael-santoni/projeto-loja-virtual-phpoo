<?php

namespace App\Classes;

use App\Interfaces\InterfaceGerenciaStatusTransaction;

class PaypallAdapter implements InterfaceGerenciaStatusTransaction {

    public function gerenciaStatus($status){

        switch ($status) {
            case 'Approved':
                // code...
                break;

            case 'Cancelled':
                // code...
                break;

            case 'Completed':
                // code...
                break;

            case 'Revoked':
                // code...
                break;

            case '5':
                // code...
                break;

            case '6':
                // code...
                break;

            case '7':
                // code...
                break;

        }

    }

}
