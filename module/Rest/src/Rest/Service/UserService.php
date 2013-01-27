<?php

namespace Rest\Service;

class UserService extends AbstractService
{
    protected $modelName = "User";

    public function getUserByEmail($email) {
        try {
            return $this->getModel()->getUserByEmail($email);
        }
        catch (\Exception $e) {
            error_log($e);
        }
        return null;
    }
}
