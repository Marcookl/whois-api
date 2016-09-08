<?php
// Routes

$app->get('/', 'App\Action\HomeAction:dispatch')
    ->setName('homepage');

$app->get('/healthcheck', 'App\Action\HomeAction:dispatch');

$app->group('/lookup', function () {
    $this->get('/', 'App\Action\ErrorAction:dispatch');
    $this->get('', 'App\Controllers\LookupController:lookupAction');
});
