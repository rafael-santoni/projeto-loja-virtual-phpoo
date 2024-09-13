<?php

namespace App\Classes;

use App\Interfaces\InterfaceTemplateEmail;
use App\Classes\TemplateFormat;

class TemplateContato extends TemplateFormat implements InterfaceTemplateEmail {

    public function template($dados){

        $template = file_get_contents(parent::PATH_TO_EMAILS_FORMATED.'/email_contato.php');

        return $this->replaceVariables($template, $dados);

    }

}
