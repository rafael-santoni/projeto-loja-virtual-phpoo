<?php

use App\Classes\Template;
use App\Classes\FunctionsTwig;
use App\Classes\AddFunctionsTwig;
use App\Classes\Parameters;
use App\Classes\UsersOnline;
use App\Classes\RetornaEstoque;
use App\Classes\CarrinhosAbandonados;
use Predis\Autoloader;
use Predis\Client;

// Definindo o Fuso Horário
date_default_timezone_set('America/Sao_Paulo');

// Iniciando o Twig
$template = new Template;
$twig = $template->init();

// Chamando o Redis
Autoloader::register();
$client = new Client([
    'scheme' => 'tcp',
    'host' => '127.0.0.1',
    'port' => 6379,
]);

// Chamando as funções do FunctionsTwig
$functionsTwig = new FunctionsTwig;
$functionsTwig->run();

$addFunctionsTwig = new AddFunctionsTwig;
$addFunctionsTwig->run($twig, $functionsTwig);

// Registrando Usuários Online no Site
$usersOnline = new UsersOnline;
$usersOnline->run();

// Limpando Carrinhos Abandonados
CarrinhosAbandonados::remove(new RetornaEstoque);

/**
 * Chamando o controller digitado na URL
 * http://localhost:8127/controller
 */
$callController = new App\Controllers\Controller;
$calledController = $callController->controller();

$controller = new $calledController();
$controller->setTwig($twig);
$controller->setCache($client);

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
