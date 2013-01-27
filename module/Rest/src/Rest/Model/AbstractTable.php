<?php

namespace Rest\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;

abstract class AbstractTable extends AbstractTableGateway
{
    abstract public function __construct(Adapter $adapter);

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }

    public function getById($id)
    {
        $id  = (int) $id;

        $rowset = $this->select(array(
            'id' => $id
        ));
        $row = $rowset->current();

        if (!$row) {
            //throw new \Exception("Could not find id: $id");
        }
        return $row;
    }

    public function save(RestUser $obj)
    {
        $data = $obj->toArray();

        $id = (int) $obj->getId();

        if ($id == 0) {
            $this->insert($data);
        } elseif ($this->getById($id)) {
            $this->update(
                $data,
                array(
                    'id' => $id,
                )
            );
        } else {
            //throw new \Exception('Form id does not exist');
        }
    }

    public function delete($id)
    {
        $this->delete(array(
            'id' => $id
        ));
    }

}
