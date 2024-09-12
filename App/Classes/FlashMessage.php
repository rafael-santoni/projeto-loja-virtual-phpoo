<?php

namespace App\Classes;

class FlashMessage {

    public function add($index, $mensagem, $tipo=null){

        $tipoMensagem = ($tipo == null) ? 'danger' : $tipo;

        if(!isset($_SESSION['flash'][$index])) {
            $_SESSION['flash'][$index] = '<div class="alert alert-'.$tipoMensagem.'">'.$mensagem.'</div>';
        }

    }

    public function show($index){

        if(isset($_SESSION['flash'][$index])) {
            $mensagem = $_SESSION['flash'][$index];
        }

        self::removeMessage($index);

        return isset($mensagem) ? $mensagem : '';

    }

    public static function removeMessage($index) {
        unset($_SESSION['flash'][$index]);
    }

}
