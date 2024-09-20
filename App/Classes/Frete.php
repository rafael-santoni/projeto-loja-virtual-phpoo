<?php

namespace App\Classes;

class Frete {

    private static function calculouFrete(){

        if(!isset($_SESSION['frete']) || $_SESSION['frete'] != true) {
            return false;
        }

        return true;

    }

    public function gravarFrete($frete){

        $_SESSION['frete'] = true;
        $_SESSION['valor'] = $frete;

    }

    public static function pegarFrete(){

        if(self::calculouFrete()){
            return $_SESSION['valor'];
        }

        return 0;

    }

    public static function formatFreteToObject(){

        $data = [
            'produtos' => (object)[
                'id' => 1,
                'produto_nome' => 'Frete'
            ],
            'qtd' => 1,
            'valor' => self::pegarFrete()
        ];

        return $data;

    }

    public static function limparFrete(){

        unset($_SESSION['frete']);
        unset($_SESSION['valor']);

    }

}
