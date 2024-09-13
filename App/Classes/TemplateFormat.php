<?php

namespace App\Classes;

class TemplateFormat {

    public function replaceVariables($template, $dados){

        foreach ($dados as $key => $dado) {

            $allKeys[] = '#'.$key;
            // $allValues[] .= $dado;
            $allValues[] = $dado;

        }

        $data = str_replace($allKeys, $allValues, $template);

        return $data;

    }

}
