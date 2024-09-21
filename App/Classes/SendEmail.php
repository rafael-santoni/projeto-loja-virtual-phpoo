<?php

namespace App\Classes;

use App\Interfaces\InterfaceTemplateEmail;
use App\Classes\Email;
use App\Classes\FlashMessage;
use App\Classes\PersistInput;

class SendEmail {

    private $email;
    private $mensagem;

    public function __construct(){
        $this->email = new Email;
    }

    public function setMensagem($mensagem){
        $this->mensagem = $mensagem;
    }

    private function validateAndSend(){

        if($this->email->enviar()){

            FlashMessage::add('email','Email enviado com sucesso!','success');
            PersistInput::removeInputs();

        } else {
            FlashMessage::add('email','Erro ao enviar o email!');
        }

    }

    public function send(array $data, InterfaceTemplateEmail $template){

        $this->email->setPara($data[0]);
        $this->email->setQuem($data[1]);
        $this->email->setAssunto($data[2]);
        $this->email->setMensagem($this->mensagem);
        $this->email->setTemplate($template);

        $this->validateAndSend();

    }

}
