<?php

namespace Application\Service;

use Zend\Http\Client;

class RestService extends AbstractService
{
    private $client;

    private $arrData;
    private $url;
    private $method;

    //hacer que esta apiKey y secretKey sean variables globales por configuracion
    private $apiKey = "prueba1";
    private $secretKey = "secretKey";

    function __construct()
    {
        $this->client = new Client();
        $this->client->setAdapter('Zend\Http\Client\Adapter\Curl');
        $this->client->setOptions(array(
            'maxredirects' => 0,
            'timeout'      => 100
        ));

    }

    public function call($request, $url) {

        if ($this->getMethod() == 'GET') $this->setGetParameters(); else $this->setPostParameters();
        $this->client->setMethod($this->getMethod());
        $this->client->setUri('http://' . $request->getServer('HTTP_HOST') . '/' . $url);
        $this->securityCall();

        $response = $this->client->send();
        if (!$response->isSuccess()) {
            // report failure
            $message = $response->getStatusCode() . ': ' . $response->getReasonPhrase();
            $response->setContent($message);
            return $response;

        }
        return $response->getBody();
    }

    public function setGetParameters() {
        $this->client->setHeaders(array('content-type' => 'multipart/form-data'));
        $this->client->setParameterGet($this->getArrData());
    }

    public function setPostParameters() {
        $this->client->setParameterPost($this->getArrData());
    }

    public function setArrData($arrData)
    {
        $this->arrData = $arrData;
    }

    public function getArrData()
    {
        return $this->arrData;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    private function securityCall() {

        $timeStamp = $this->createTimeStamp();
        $hash = $this->createHash($this->getUrl(), $this->getMethod(), "", $timeStamp, $this->getArrData(), $this->secretKey);

        error_log($hash);
        //$this->client->setHeaders(array("authorization" => $this->apiKey . ',' .
        //                                                   $timeStamp . ',' .
        //                                                   $hash));
    }

    private function createTimeStamp() {
        date_default_timezone_set('UTC');
        $utc_str = gmdate("M d Y H:i:s", time());
        return strtotime($utc_str);
    }

    private function createHash($controller, $method, $id, $timeStamp, array $data, $secretKey) {
        $str = $controller . $method;
        if ($id != null) $str .= $id;
        if ($timeStamp != null) $str .= $timeStamp; else return null;

        //ordeno todos el array de  parametros
        ksort($data);
        foreach($data as $key => $value) {
            $str .= "$key=$value";
        }
        $hmac = Hmac::compute($secretKey,"sha256", $str, Hmac::OUTPUT_STRING);
        //var_dump($hmac);
        return $hmac;
    }

}
