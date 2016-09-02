<?php
// DIC configuration

$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

$container['whois'] = function ($c) {
    return new phpWhois\Whois();
};

// -----------------------------------------------------------------------------
// Model factories
// -----------------------------------------------------------------------------

$container['model'] = function ($c) {
    return new App\Models\WhoisData;
};

// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------

$container['App\Action\HomeAction'] = function ($c) {
    return new App\Action\HomeAction();
};

$container['App\Controllers\LookupController'] = function ($c) {
    return new App\Controllers\LookupController($c['whois'], $c['model']);
};

