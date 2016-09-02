<?php
namespace App\Action;

final class ErrorAction
{
    public function dispatch($request, $response, $args)
    {

        $message = [
            'param' => 'domain',
            'msg' => 'url can not be empty'
        ];

        return $response->withStatus(500)
            ->withJson($message);

    }
}
