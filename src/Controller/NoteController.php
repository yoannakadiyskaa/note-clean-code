<?php


namespace App\Controller;


use App\AbstractController;
use App\Service\NoteService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class NoteController extends AbstractController
{
    public static function create(RequestInterface $request, ResponseInterface $response)
    {
        $service = new NoteService();
        $result = $service->create('testy test');

        return self::writeOutputAsJson($response, [
            'success' => $result
        ]);
    }
    public static function get(RequestInterface $request, ResponseInterface $response)
    {
        $service = new NoteService();
        $parameters = self::readJsonFromRequest($request);
        if (is_null($parameters['id']) || ! is_numeric($parameters['id'])) {
            throw new \InvalidArgumentException('missing or invalid id');
        }
        $note = $service->get($parameters['id']);

        return self::writeOutputAsJson($response, [
            'note' => $note
        ]);
    }
    public static function list(RequestInterface $request, ResponseInterface $response)
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