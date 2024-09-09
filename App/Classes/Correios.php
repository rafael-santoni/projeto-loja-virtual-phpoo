<?php

namespace App\Classes;

use Cagartner\CorreiosConsulta\CorreiosConsulta;

class Correios {

    private $correios;
    private $tipo;
    private $formato;
    private $cepDestino;
    private $cepOrigem;
    private $peso;
    private $comprimento;
    private $altura;
    private $largura;
    private $diametro;

    public function __construct(){
        $this->correios = new CorreiosConsulta;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function setFormato($formato){
        $this->formato = $formato;
    }

    public function setCepDestino($cepDestino){
        $this->cepDestino = $cepDestino;
    }

    public function setCepOrigem($cepOrigem){
        $this->cepOrigem = $cepOrigem;
    }

    public function setPeso($peso){
        $this->peso = $peso;
    }

    public function setComprimento($comprimento){
        $this->comprimento = $comprimento;
    }

    public function setAltura($altura){
        $this->altura = $altura;
    }

    public function setLargura($largura){
        $this->largura = $largura;
    }

    public function setDiametro($diametro){
        $this->diametro = $diametro;
    }

    private function dadosCalcularFrete(){

        $dados = [
            'tipo'              => $this->tipo, // Separar opções por vírgula (,) caso queira consultar mais de um (1) serviço. > Opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
            'formato'           => $this->formato, // opções: `caixa`, `rolo`, `envelope`
            'cep_destino'       => $this->cepDestino, // Obrigatório
            'cep_origem'        => $this->cepOrigem, // Obrigatorio
            //'empresa'         => '', // Código da empresa junto aos correios, não obrigatório.
            //'senha'           => '', // Senha da empresa junto aos correios, não obrigatório.
            'peso'              => $this->peso, // Peso em kilos
            'comprimento'       => $this->comprimento, // Em centímetros
            'altura'            => $this->altura, // Em centímetros
            'largura'           => $this->largura, // Em centímetros
            'diametro'          => $this->diametro, // Em centímetros, no caso de rolo
            // 'mao_propria'       => '1', // Náo obrigatórios
            // 'valor_declarado'   => '1', // Náo obrigatórios
            // 'aviso_recebimento' => '1', // Náo obrigatórios
        ];

        return $dados;

    }

    public function calcularFrete(){
        return $this->correios->frete($this->dadosCalcularFrete());
    }

}
