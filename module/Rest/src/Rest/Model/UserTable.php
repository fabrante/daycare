<?php

namespace Rest\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;

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

    public function getUserLogin($userName, $passHash) {

        $rowSet = $this->select(function (Select $select) use ($userName, $passHash) {
            $select->where->equalTo("email", $userName);
            $select->where->equalTo("password", $passHash);
        });
        $row = $rowSet->current();

        if (!$row) {
            //throw new \Exception("Could not find userName: $userName");
        }
        return $row;
    }
}
