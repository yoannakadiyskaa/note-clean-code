<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Application;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

ini_set('display_errors', true);
ini_set('display_startup_errors', true);
error_reporting(E_ALL);

$application = new Application();

const BASE_DIR = __DIR__ . '/..';
$routes = include BASE_DIR . "/app/routes.php";
$routes($application);

$requestCreator = new ServerRequestCreator(
    new Psr17Factory(),
    new Psr17Factory(),
    new Psr17Factory(),
    new Psr17Factory(),
);
$request = $requestCreator->fromGlobals();

$response = $application->handle($request);
$result = (new SapiEmitter())->emit($response);