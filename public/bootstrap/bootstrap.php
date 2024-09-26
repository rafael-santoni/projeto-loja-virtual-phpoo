<?php

use App\Classes\Template;
use App\Classes\FunctionsTwig;
use App\Classes\AddFunctionsTwig;
use App\Classes\Parameters;
use App\Classes\UsersOnline;
use Predis\Autoloader;
use Predis\Client;

date_default_timezone_set('America/Sao_Paulo');

$template = new Template;
$twig = $template->init();

Autoloader::register();
$client = new Client();

// Chamando as funções do FunctionsTwig
$functionsTwig = new FunctionsTwig;
$functionsTwig->run();

$addFunctionsTwig = new AddFunctionsTwig;
$addFunctionsTwig->run($twig, $functionsTwig);

// $twig->addFunction($site_url);
// $twig->addFunction($categorias);
// $twig->addFunction($marcas);
// $twig->addFunction($novidade);
// $twig->addFunction($promocao);
// $twig->addFunction($breadCrumb);
// $twig->addFunction($valorProdutosCarrinho);
// $twig->addFunction($numeroProdutosCarrinho);
// // $twig->addFunction($dadosFrete);
// $twig->addFunction($totalComFrete);
// $twig->addFunction($logado);
// $twig->addFunction($user);
// $twig->addFunction($errorField);
// $twig->addFunction($persist);
// $twig->addFunction($flash);
// $twig->addFunction($estoque);
// $twig->addFunction($statusPagamento);
// $twig->addFunction($statusPedido);

$usersOnline = new UsersOnline;
$usersOnline->run();

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
