<?php

namespace Rest\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class UserTable extends AbstractTable
{
    protected $table ='user';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new User());

        $this->initialize();
    }

    public function getUserLogin($userName) {

        $row = $this->select(array("email" => $userName))->current();
        if (!$row) {
            throw new \Exception("Could not find apiKey: $userName");
        }
        return $row;
    }
}
