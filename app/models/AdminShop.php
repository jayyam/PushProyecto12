<?php

class AdminShop
{
    private $db;

    public function __construct()
    {
        $this->db = Mysqldb::getInstance()->getDatabase();//creando logica: controlador --> modelo --> indice VISTA
    }
}
