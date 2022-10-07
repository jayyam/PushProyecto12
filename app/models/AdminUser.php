<?php

class AdminUser
{
    private $db;

    public function __construct()
    {
        $this->db = Mysqldb::getInstance()->getDatabase();//creando logica: controlador --> modelo --> indice VISTA
    }

    public function createAdminUser($data)
    {
        $response = false;

        if (!$this->existsEmail($data['email']))
        {
            //encriptar contraseña
            $password = hash_hmac('sha512', $data['password'], ENCRIPTKEY);

            //defino sentencia sql
            $sql = 'INSERT INTO admins(name, email, password, status, deleted, login_at, updated_at, deleted_at 
                    VALUES(:name, :email, :password, :status, :deleted, :login_at, :updated_at, :deleted_at)';

            $params = [
                ':name' => $data['name'],
                ':email' => $data['email'],
                ':password' => $password,
                ':status' => 1,
                ':deleted' => 0,
                ':login_at' => null,
                ':created_at' => date('Y-m-d H:i:s'),
                ':updated_at' => null,
                ':deleted_at' => null,
            ];
            $query = $this->db->prepare($sql);
            $response = $query->execute($params);

        }
        return $response;
    }
    public function existEmail()
    {
        $sql = 'SELECT * FROM admins WHERE email=:email';
        $query = $this->db->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        return $query->rowCount();
    }

    public function getUser()
    {
        $sql = 'SELECT *FROM admins WHERE deleted = 0';
        $query =  $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUserByID($id)
    {
        $sql = 'SELECT * FROM admins WHERE id=:id';
        $query = $this->db->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }
}