<?php
/*
    --***************************--
    *****    Removed Class    *****
    *****                     *****
    *****   Esta classe foi   *****
    ***** removida do projeto *****
    --***************************--

namespace App\Classes;

use App\Models\Site\PedidosModel;
use App\Models\Site\CarrinhoModel;
use App\Classes\Estoque;
use App\Classes\Email;
use App\Classes\TemplateEmDisputa;
use App\Interfaces\InterfaceStatusTransaction;

class PagseguroStatusTransaction implements InterfaceStatusTransaction {

    private $pedidos;
    private $email;
    private $dataPagseguro;
    private $carrinho;
    private $estoque;

    public function __construct($dataPagseguro){

        $this->dataPagseguro = $dataPagseguro;
        $this->pedidos = new PedidosModel;
        $this->email = new Email;
        $this->estoque = new Estoque;
        $this->carrinho = new CarrinhoModel;

    }

    public function aguardePagamento(){

        // $this->email->setPara($this->dataPagseguro->sender->email);    ## DEScomentar para usar no Ambiente de Produção
        $this->email->setPara('rafatony.consultor@gmail.com');    ## COMENTAR esta linha para usar no Ambiente de Produção
        $this->email->setQuem('contato@empresa.com.br');
        $this->email->setAssunto('Aguardando seu pagamento');
        $this->email->setMensagem([
            'nome' => $this->dataPagseguro->sender->name,
            'data' => date('d/m/Y H:i:s')
        ]);
        $this->email->setTemplate(new TemplateAguardePagamento);

        $this->email->enviar();

    }

    public function pagamentoAnalise(){

        // $this->email->setPara($this->dataPagseguro->sender->email);    ## DEScomentar para usar no Ambiente de Produção
        $this->email->setPara('rafatony.consultor@gmail.com');    ## COMENTAR esta linha para usar no Ambiente de Produção
        $this->email->setQuem('contato@empresa.com.br');
        $this->email->setAssunto('Seu pagamento está em análisa');
        $this->email->setMensagem([
            'nome' => $this->dataPagseguro->sender->name,
            'data' => date('d/m/Y H:i:s')
        ]);
        $this->email->setTemplate(new TemplatePagamentoAnalise);

        $this->email->enviar();

    }

    public function vendaAprovada(){

        // $this->email->setPara($this->dataPagseguro->sender->email);    ## DEScomentar para usar no Ambiente de Produção
        $this->email->setPara('rafatony.consultor@gmail.com');    ## COMENTAR esta linha para usar no Ambiente de Produção
        $this->email->setQuem('contato@empresa.com.br');
        $this->email->setAssunto('Seu pagamento foi aprovado');
        $this->email->setMensagem([
            'nome' => $this->dataPagseguro->sender->name,
            'data' => date('d/m/Y H:i:s')
        ]);
        $this->email->setTemplate(new TemplateVendaAprovada);

        $this->email->enviar();

    }

    public function pagamentoDisponivel(){

        // $this->email->setPara($this->dataPagseguro->sender->email);    ## DEScomentar para usar no Ambiente de Produção
        $this->email->setPara('rafatony.consultor@gmail.com');    ## COMENTAR esta linha para usar no Ambiente de Produção
        $this->email->setQuem('contato@empresa.com.br');
        $this->email->setAssunto('O pagamento está disponível');
        $this->email->setMensagem([
            'nome' => $this->dataPagseguro->sender->name,
            'data' => date('d/m/Y H:i:s')
        ]);
        $this->email->setTemplate(new TemplatePagamentoDisponivel);

        $this->email->enviar();

    }

    public function emDisputa(){

        // $this->email->setPara($this->dataPagseguro->sender->email);    ## DEScomentar para usar no Ambiente de Produção
        $this->email->setPara('rafatony.consultor@gmail.com');    ## COMENTAR esta linha para usar no Ambiente de Produção
        $this->email->setQuem('contato@empresa.com.br');
        $this->email->setAssunto('Aberta a disputa');
        $this->email->setMensagem([
            'nome' => $this->dataPagseguro->sender->name,
            'data' => date('d/m/Y H:i:s')
        ]);
        $this->email->setTemplate(new TemplateEmDisputa);

        $this->email->enviar();

    }

    public function valorDevolvido(){

        // $this->email->setPara($this->dataPagseguro->sender->email);    ## DEScomentar para usar no Ambiente de Produção
        $this->email->setPara('rafatony.consultor@gmail.com');    ## COMENTAR esta linha para usar no Ambiente de Produção
        $this->email->setQuem('contato@empresa.com.br');
        $this->email->setAssunto('Seu valor foi devolvido');
        $this->email->setMensagem([
            'nome' => $this->dataPagseguro->sender->name,
            'data' => date('d/m/Y H:i:s')
        ]);
        $this->email->setTemplate(new TemplateValorDevolvido);

        $this->email->enviar();

    }

    public function compraCancelada(){

        // $this->email->setPara($this->dataPagseguro->sender->email);    ## DEScomentar para usar no Ambiente de Produção
        $this->email->setPara('rafatony.consultor@gmail.com');    ## COMENTAR esta linha para usar no Ambiente de Produção
        $this->email->setQuem('contato@empresa.com.br');
        $this->email->setAssunto('Sua compra foi cancelada');
        $this->email->setMensagem([
            'nome' => $this->dataPagseguro->sender->name,
            'data' => date('d/m/Y H:i:s')
        ]);
        $this->email->setTemplate(new TemplateCompraCancelada);

        $this->email->enviar();

    }

}
*/