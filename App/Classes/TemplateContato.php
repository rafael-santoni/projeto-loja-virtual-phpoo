<?php

namespace App\Classes;

use App\Interfaces\InterfaceTemplateEmail;

class TemplateContato implements InterfaceTemplateEmail {

    public function template($dados){

        $template = file_get_contents('emails/email_contato.php');

    }

}
