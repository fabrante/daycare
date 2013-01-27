<?php

namespace Rest\Model;

class User
{
    protected $id;
    protected $name;
    protected $lastName;
    protected $userType;
    protected $email;
    protected $password;
    protected $state;
    protected $creationDate;
    protected $modificationDate;

    public function exchangeArray($data)
    {
        $this->setId(isset($data['id']) ? $data['id'] : null);
        $this->setName(isset($data['name']) ? $data['name'] : null);
        $this->setLastName(isset($data['lastName']) ? $data['lastName'] : null);
        $this->setUserType(isset($data['userType']) ? $data['userType'] : null);
        $this->setEmail(isset($data['email']) ? $data['email'] : null);
        $this->setPassword(isset($data['password']) ? $data['password'] : null);
        $this->setState(isset($data['state']) ? $data['state'] : null);
        $this->setCreationDate(isset($data['creationDate']) ? $data['creationDate'] : null);
        $this->setModificationDate(isset($data['modificationDate']) ? $data['modificationDate'] : null);
    }

    public function toArray(){
        $data = array(
            'name'              => $this->getName(),
            'lastName'          => $this->getLastName(),
            'userType'          => $this->getUserType(),
            'email'             => $this->getEmail(),
            'password'          => $this->getPassword(),
            'state'             => $this->getState(),
            'creationDate'      => $this->getCreationDate(),
            'modificationDate'  => $this->getModificationDate(),
        );
        return $data;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;
    }

    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    public function getUserType()
    {
        return $this->userType;
    }
}
