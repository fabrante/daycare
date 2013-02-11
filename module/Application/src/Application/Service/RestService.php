<?php

namespace Application\Service;

use Zend\Http\Client;

class RestService extends AbstractService
{
    private $client;


    function __construct()
    {
        $this->client = new Client();
        $this->client->setAdapter('Zend\Http\Client\Adapter\Curl');
        $this->client->setHeaders(array('content-type' => 'multipart/form-data'));
        $this->client->setOptions(array(
            'maxredirects' => 0,
            'timeout'      => 100
        ));

    }

    public function call($request, $response, $url) {

        $server = $request->getRequestUri();
        error_log($server);
        $this->client->setUri($server + $url);

        $response = $this->client->send();
        if (!$response->isSuccess()) {

            // report failure
            $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();
            $response->setContent($message);
            return $response;

        }
        return $response->getBody();
    }

    public function setGetParameters($arrData) {
        $this->client->setMethod('GET');
        $this->client->setParameterGet($arrData);
    }

    public function setPostParameters($arrData) {
        $this->client->setMethod('POST');
        $this->client->setParameterPost($arrData);
    }

}
