<?php


namespace App;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AbstractController
{
    const VIEW_DIRECTORY_PATH = BASE_DIR . '/src/View';

    public static function getParsedTemplate(string $templatePath, array $variables): string
    {
        extract($variables);
        $templateFolderPath = self::VIEW_DIRECTORY_PATH;
        ob_start();
        include($templateFolderPath . '/' . $templatePath . '.phtml');
        $partial = ob_get_contents();
        ob_end_clean();

        return $partial;
    }

    public static function writeOutputAsJson(ResponseInterface $response, array $data)
    {
        $response->getBody()->write(json_encode($data, JSON_PRETTY_PRINT));
        return $response->withHeader('Content-Type', 'application/json');
    }

    protected static function readJsonFromRequest(RequestInterface $request): array
    {
        $json = json_decode($request->getBody(), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $json = [];
        }
        return $json;
    }
}