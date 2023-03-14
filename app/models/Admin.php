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

        $password =hash_hmac('sha512', $data['password'], ENCRIPTKEY );
        $sql = 'SELECT * FROM admins WHERE email=:email';
        $query = $this->db->prepare($sql);
        $query->bindParam(':email',$data['user'], PDO::PARAM_STR);
        $query->execute();
        $admins = $query->fetchAll(PDO::FETCH_OBJ);

        //$bugegu=hash_init('sha512',  0,  "ENCRIPTKEY", ['806cc6e9290ccac7e77a34f545b28fdf3c8a87dab0f144f3885b2411483e433df0a34d9d11355f20b74df86b9bbbe5dd95d4046be9430851b8fbdbc390dc8e54']);
       //var_dump($bugegu);

        if (! $admins)
        {
            array_push($errors, 'Usuario no existe en nuestros registros1');

        }
        elseif (count($admins) > 1)
        {
            array_push($errors, 'Corrreo duplicado');
        }
        elseif ($password != $admins[0]->password)
        {
            array_push($errors, 'Clave acceso incorrecta');
        }
        elseif ($admins[0]->status == 0)
        {
            array_push($errors, 'El usuario esta desactivado');
        }
        elseif ($admins[0]->deleted == 1)
        {
            array_push($errors, 'El usuario no existe en nuestros registros2');
        }
        else
        {
            $sql2 = 'UPDATE admins SET login_at=:login_at WHERE id=:id';
            $query2 = $this->db->prepare($sql2);
            //var_dump(date('Y-m-d H:i:s'));
            $params = [
                ':login_at' => date('Y-m-d H:i:s'),
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
