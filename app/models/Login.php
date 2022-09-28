<?php

class login
{
    private $db;

    public function __construct()
    {
        $this->db = Mysqldb::getInstance();
    }

}