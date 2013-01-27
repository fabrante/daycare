<?php

namespace Rest\Model;

class RestUser
{
    protected $id;
    protected $apiKey;
    protected $secretKey;
    protected $name;
    protected $description;
    protected $creationDate;
    protected $modificationDate;
    protected $active;

    public function exchangeArray($data)
    {
        $this->setId(isset($data['id']) ? $data['id'] : null);
        $this->setApiKey(isset($data['apiKey']) ? $data['apiKey'] : null);
        $this->setSecretKey(isset($data['secretKey']) ? $data['secretKey'] : null);
        $this->setName(isset($data['name']) ? $data['name'] : null);
        $this->setDescription(isset($data['description']) ? $data['description'] : null);
        $this->setCreationDate(isset($data['creationDate']) ? $data['creationDate'] : null);
        $this->setModificationDate(isset($data['modificationDate']) ? $data['modificationDate'] : null);
        $this->setActive(isset($data['active']) ? $data['active'] : null);
    }

    public function toArray(){
        $data = array(
            'apikey'            => $this->getApiKey(),
            'secretKey'         => $this->getSecretKey(),
            'name'              => $this->getName(),
            'description'       => $this->getDescription(),
            'creationDate'      => $this->getCreationDate(),
            'modificationDate'  => $this->getModificationDate(),
            'active'            => $this->getActive(),
        );
        return $data;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;
    }

    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }



}
