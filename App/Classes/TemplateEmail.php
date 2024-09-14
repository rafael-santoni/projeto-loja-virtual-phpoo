<?php

namespace App\Classes;

class TemplateEmail {

    const PATH_TO_EMAILS_FORMATED = 'emails';

    private $allKeys = [];
    private $allValues = [];

    public function replaceVariables($template, $dados){


        foreach ($dados as $key => $dado) {

            $this->$allKeys[] = '#'.$key;
            $this->$allValues[] = $dado;

        }

        $data = str_replace($allKeys, $allValues, $template);

        return $data;

    }

}
