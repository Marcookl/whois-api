<?php

namespace App\Controllers;

use App\Abstracts\BaseController;

final class LookupController extends BaseController
{

    public function lookupAction($request, $response, $args)
    {

        $domain = $request->getParam('query');
        $domain = preg_replace('/^(?:https?:)?\/\//', '', $domain);

        $server = $request->getParam('server');
        $tld = $request->getParam('tld');

        $deep = $request->getParam('deep');

        $this->whois->deepWhois = true;

        if(empty($domain)) {
            return $response->withRedirect('/lookup/');
        }

        if (isset($deep) && (($deep == 'false') || !$deep)) {
            $this->whois->deepWhois = false;
        }

        if(isset($server) && isset($tld)) {
            $this->whois->useServer($tld, $server);
        }

        $result = $this->whois->lookup($domain);

        if($result === false || !is_array($result)) {

           return $response->withStatus(500)
               ->withJson(array('error', 'Not found'));
        }

        $minLinesExpectedInResponse = 5; 
        $isExceededResponse = strpos(implode(' ', $result['rawdata']), 'WHOIS LIMIT EXCEEDED') !== false;

        if (
            count($result['rawdata']) < $minLinesExpectedInResponse
            || $isExceededResponse
        ) {
           return $response->withStatus(429)
               ->withJson(array('error', 'Quota exceeded'));
        };

        if(isset($result)) {
          $this->model->setInfo($result);
        }

        $model = $this->model->toArray();
        return $response->withJson($model['data'], 200, JSON_PARTIAL_OUTPUT_ON_ERROR);
    }
}
