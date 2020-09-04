<?php
namespace App\Controller;

use App\AbstractController;
use App\Service\NoteService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController extends AbstractController
{
    public static function index(RequestInterface $request, ResponseInterface $response)
    {
        $service = new NoteService();
        $notes = $service->listAll();

        $output = self::getParsedTemplate('index', [
            'notes' => $notes
        ]);
        $response->getBody()->write($output);
        return $response;
    }
}