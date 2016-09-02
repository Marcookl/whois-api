<?php

namespace App\Abstracts;

use \App\Models\WhoisData;
use phpWhois\Whois;

abstract class BaseController
{
    protected $whois;
    protected $model;

    public function __construct(Whois $whois, WhoisData $model)
    {
        $this->whois = $whois;
        $this->model = $model;
    }
}
