<?php
namespace App\Action;

final class HomeAction
{
    public function dispatch($request, $response, $args)
    {

        $message = [
            'app' => 'whois-api',
            'version' => '0.0.10'
        ];

        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withJson($message);

    }
}
