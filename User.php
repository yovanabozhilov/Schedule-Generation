<?php

namespace model;

class User 
{
    private $user_id;
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $isAdmin;

    public function __construct($email, $password, $firstName, $lastName, $isAdmin)
    {
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->isAdmin = $isAdmin;
    }


    public function getUserId()
    {
        return $this->user_id;
    }


    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function getFirstName()
    {
        return $this->firstName;
    }


    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }


    public function getLastName()
    {
        return $this->lastName;
    }


    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getIsAdmin() {
		
        return $this->isAdmin;
    }


    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

}