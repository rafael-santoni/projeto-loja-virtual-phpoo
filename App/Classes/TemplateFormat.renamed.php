<?php
/*
    --************************--
    ***** Deprecated Class *****
    ***** Esta classe foi  *****
    *****  renomeada para  *****
    ***** TemplateEmail.php ****
    --************************--

namespace App\Classes;

class TemplateFormat {

    const PATH_TO_EMAILS_FORMATED = 'emails';

    private $allKeys = [];
    private $allValues = [];

    public function replaceVariables($template, $dados){

        // $allValues = []

        foreach ($dados as $key => $dado) {

            $this->$allKeys[] = '#'.$key;
            // $allValues[] .= $dado;
            $this->$allValues[] = $dado;

        }

        $data = str_replace($allKeys, $allValues, $template);

        return $data;

    }

}
*/