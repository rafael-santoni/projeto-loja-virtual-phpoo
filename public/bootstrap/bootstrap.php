<?php

use App\Classes\Template;
use App\Classes\Parameters;

$template = new Template;
$twig = $template->init();

// Chamando as funções do functionsTwig
$twig->addFunction($site_url);
$twig->addFunction($categorias);

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
$parameters = new Parameters;
$parameter = $parameters->getParameterMethod($controller, $method);

$controller->$method($parameter);