<?php

use App\Application;
use App\Controller\HomeController;
use App\Controller\NoteController;
use Nyholm\Psr7\Factory\Psr17Factory;

return function (Application $application)
{
    $application->addRoute('/', HomeController::class . '::index');
    $application->addRoute('/note/create', NoteController::class . '::create');
    $application->addRoute('/note/list', NoteController::class . '::list');
    $application->addRoute('/note/get', NoteController::class . '::get');
};