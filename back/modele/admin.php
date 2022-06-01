<?php

class Admin
{
    private $id;
    private $userName;
    private $mdp;

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getMdp()
    {
        return $this->mdp;
    }
}
