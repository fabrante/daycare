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
        $this->client->setOptions(array(
            'maxredirects' => 0,
            'timeout'      => 100
        ));

    }

    public function call($request, $method, $url) {

        $this->client->setMethod($method);
        $this->client->setUri('http://' . $request->getServer('HTTP_HOST') . '/' . $url);

        $response = $this->client->send();
        if (!$response->isSuccess()) {
            error_log("error login");
            // report failure
            $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();
            $response->setContent($message);
            return $response;

        }
        else {
            error_log("success");
        }
        return $response->getBody();
    }

    public function setGetParameters($arrData) {
        $this->client->setHeaders(array('content-type' => 'multipart/form-data'));
        $this->client->setParameterGet($arrData);
    }

    public function setPostParameters($arrData) {
        $this->client->setParameterPost($arrData);
    }

}
