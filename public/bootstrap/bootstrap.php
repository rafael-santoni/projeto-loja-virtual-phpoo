<?php

use App\Classes\Template;

$template = new Template;
$twig = $template->init();
// echo '<pre>'; print_r($twig); echo '</pre>'; exit();

/**
 * Chamando o controller digitado na URL
 * http://localhost:8127/controller
 */ 
$callController = new App\Controllers\Controller;
$calledController = $callController->controller();

$controller = new $calledController();
$controller->setTwig($twig);

/**
 * Chamando o método digitado na URL
 * http://localhost:8127/controller/metodo
 */
$callMethod = new App\Controllers\Method;
$method = $callMethod->method($controller);

/**
 * Chamando o controller atraves da classe Controller e da classe Method
 */
$controller->$method();