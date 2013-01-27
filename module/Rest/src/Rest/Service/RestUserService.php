<?php

namespace Rest\Service;

class RestUserService extends AbstractService
{
    protected $modelName = "RestUser";

    public function getRestUserByApiKey($apiKey) {
        try {
            return $this->getModel()->getRestUserByApiKey($apiKey);
        }
        catch (\Exception $e) {
            error_log($e);
        }
        return null;
    }
}
