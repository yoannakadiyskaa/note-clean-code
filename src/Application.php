<?php

namespace App;

use App\Utilities\HttpStatusCodes;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Application implements RequestHandlerInterface
{
    private array $routes = [];

    public function addRoute($route, $callable)
    {
        $this->routes[$route] = $callable;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $route = $request->getUri()->getPath();

        $response = new Response();
        if (isset($this->routes[$route])) {
            $response = $this->routes[$route]($request, $response);
        } else {
            $response = $response->withstatus(HttpStatusCodes::NOT_FOUND);
        }

        return $response;
    }

}