<?php

namespace Rest\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class RestUserTable extends AbstractTable
{
    protected $table ='restUser';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new RestUser());

        $this->initialize();
    }

    public function getRestUserByApiKey($apiKey) {
        $row = $this->select(array("apiKey" => $apiKey))->current();
        if (!$row) {
            throw new \Exception("Could not find apiKey: $apiKey");
        }
        return $row;
    }
}
