<?php

class Login
{
    private $db;

    public function __construct()
    {
        $this->db = Mysqldb::getInstance()->getDatabase();
    }

    public function existsEmail($email)//Comprobacion en la base de datos si existe email - PDO
    {
        $sql = 'SELECT * FROM users WHERE email=:email';
        $query = $this->db->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);//param:':email', $email, PDO::PARAM_STR
        $query->execute();

        return $query->rowCount();
    }

    public function createUser($data)//Inserciones a la base de datos
    {
        $response = false;

        if ( ! $this->existsEmail($data['email']))
        {
            //Crear usuario

            $password =hash_hmac('sha512', $data['password'], key: 'Elperrodesanroque');
            $sql = 'INSERT INTO users(first_name, last_name_1, last_name_2, email, 
                  address, city, state, zipcode, country, password) 
                  VALUES(:first_name, :last_name_1, :last_name_2, :email, 
                  :address, :city, :state, :zipcode, :country, :password)';

            $params = [
                        ':first_name' => $data['firstName'],
                        ':last_name_1' => $data['lastName1'],
                        ':last_name_2' => $data['lastName2'],
                        ':email' => $data['email'],
                        ':address' => $data['address'],
                        ':city' => $data['city'],
                        ':zipcode' =>$data['postcode'],
                        ':country' =>$data['country'],
                        ':password' =>$password,//contraseña encriptada
                      ];
            $query = $this->db->prepare($sql);
            $response = $query->execute($params);
        }
        return $response;
    }

    public function getUserByEmail($email)
    {
        $sql = 'SELECT * FROM users WHERE email=:email';
        $query = $this->db->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);//param:':email', $email, PDO::PARAM_STR
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function sendEmail($email)
    {
        $user = $this->getUserByEmail($email);

        $fullName = $user->first_name.' '.
        $user->last_name1.' '.
        $user->last_name2;//añadiendo aqui (?? ' ')elimina el requerimiento del segundo apellido. Examen

        $msg = $fullName.', accede al siguiente enlace para cambiar tu contraseña. <br>';
        $msg.='<a href="'.ROOT.'login/changePassword/'.$user->id.'">Cambia tu clave de acceso</a>';

        $headers = 'MIME-Version:1.0\r\n';
        $headers .= 'Content-type:text/html; charset=UTF-8\r\n';
        $headers .= 'From: tiendamvc\r\n';
        $headers .= 'Reply-to: administracion@tiendamvc.local';

        $subject = "Cambiar contraseña en tiendamvc";

        return mail($email, $subject, $msg, $headers); //Enviando mail
    }

}
