<?php

class Search
{
    private $db;

    public function __construct()
    {
     $this->db = Mysqldb::getInstance()->getDatabase();
    }

    public function getProducts($string)
    {
        $sql = 'SELECT * FROM products WHERE deleted=0 AND (name LIKE :name OR published LIKE :published OR author LIKE :author OR people LIKE :people OR description LIKE :description)';
        $query = $this->db->prepare($sql);

        $params = [
            ':name' => '%'.$string.'%',
            ':publisher' => "%{$string}%",//otra forma de hacer la busqueda
            ':author' => '%'.$string.'%',
            ':people' => '%' . $string . '%',
            ':description' => '%'.$string.'%',
        ];

        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}