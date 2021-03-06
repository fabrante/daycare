<?php
namespace Rest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Crypt\Hmac;

abstract class AbstractSecureController extends AbstractRestfulController
{
    private $restUserService;

    public function dispatch(Request $request, Response $response = null)
    {
        $valid = $this->validateHash($this->getEvent()->getRouteMatch()->getParam("controller"),
                            $request->getMethod(),
                            $this->getEvent()->getRouteMatch()->getParam("id"),
                            $request->getHeaders()->get("authorization"),
                            $request->getPost()->toArray());
        //TODO: definir variable global para activar y desactivar seguridad por configuracion
        //$valid = true;

        if ($valid) {
            //redirijo al controllador para seguir con las operaciones
            return parent::dispatch($request, $response);
        }
        else {
            return $this->noAuthorizedAction($response);
        }
    }

    /**
     * @param $controller controlador al que se llama
     * @param $method metodo del controlador
     * @param $id (opcional) id sobre el que van a efectuar cambios
     * @param array $data datos a cambiar
     * @return bool es valido o no la solicitud
     */
    private function validateHash($controller, $method, $id, $authHeader, array $data) {

        if ($authHeader) {
            $authHeaderArr = explode(",", $authHeader->getFieldValue());
            if (count($authHeaderArr) == 3) {
                $apiKey = $authHeaderArr[0];
                $timeStamp = $authHeaderArr[1];
                $hash = $authHeaderArr[2];

                $timeStampLocal = $this->createTimeStamp();

                //valido que la peticion no se haya realizado hace mas de 5 minutos (60*5 = 300)
                if ($timeStampLocal-$timeStamp < 300) {
                    $user = $this->getRestUserService()->getRestUserByApiKey($apiKey);
                    if ($user != null) {
                        $hashDb = $this->createHash($controller, $method, $id, $timeStamp, $data, $user->getSecretKey());
                        if ($hashDb == $hash) {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    private function createTimeStamp() {
        date_default_timezone_set('UTC');
        $utc_str = gmdate("M d Y H:i:s", time());
        return strtotime($utc_str);
    }

    private function createHash($controller, $method, $id, $timeStamp, array $data, $secretKey) {
        //TODO: mejorar esto, sacar el nombre del modulo de otro lado
        $str = "rest/".$controller . $method;
        if ($id != null) $str .= $id;
        if ($timeStamp != null) $str .= $timeStamp; else return null;

        //ordeno todos el array de  parametros
        ksort($data);
        foreach($data as $key => $value) {
            $str .= "$key=$value";
        }
        return Hmac::compute($secretKey,"sha256", $str, Hmac::OUTPUT_STRING);
    }

    public function noAuthorizedAction(Response $response) {
        $response->setStatusCode(401); //401 No Authorized
        return array('content' => 'Unauthorized action');
    }

    public function getRestUserService()
    {
        return (!$this->restUserService ? $this->getServiceLocator()->get('RestUserService') : $this->restUserService);
    }

}
