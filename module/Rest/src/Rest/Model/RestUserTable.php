<?php

namespace Rest\Model;

use Zend\Db\Sql\Select;
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

        $rowSet = $this->select(function (Select $select) use ($apiKey) {
            $select->where->equalTo("apiKey", $apiKey);
            $select->where->equalTo("active", 1);
        });
        $row = $rowSet->current();
        if (!$row) {
            throw new \Exception("Could not find apiKey: $apiKey");
        }
        return $row;
    }
}
