<?php

class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = Mysqldb::getInstance()->getDatabase();//creando logica: controlador --> modelo --> indice VISTA
    }

    public function verifyUser($data)
    {
        $errors = [];


        $password =hash_hmac('sha512', $data['password'], key: 'ENCRIPTKEY');

        $sql = 'SELECT * FROM admins WHERE email:=email';
        $query = $this->db->prepare($sql);
        $query->bindParam('email', $data['email'], PDO::PARAM_STR);
        $query->execute();
        $admins = $query->fetchAll(PDO::FETCH_OBJ);



        if (! $admins)
        {
            array_push($errors, 'Usuario no existe en nuestros registros');

        }
        elseif (count($admins) >1)
        {
            array_push($errors, 'Corrreo duplicado');
        }
        elseif ($password != $admins[0]->$password)
        {
            array_push($errors, 'Clave acceso incorrecta');
        }
        else
        {
            $sql2 = 'UPDATE admins SET login_at=:login WHERE id:id';
            $query2 = $this->db->prepare($sql2);

            $params = [
                'login' => date('Y-m-d H:i:s'),
                ':id' => $admins[0]->id,
            ];
            if ( ! $query2->execute($params))
            {
                array_push($errors, 'Error al modificar la fecha de último acceso');
            }

        }
        return $errors;
    }
}