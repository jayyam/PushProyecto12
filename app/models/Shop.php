<?php

class Shop
{
    private $db;

    public function __construct()
    {
        $this->db = Mysqldb::getInstance()->getDatabase();
    }






































    public function sendEmail($name, $email, $message)
    {

        $msg = $name.', Envia un mensaje nuevo. <br>';
        $msg.= 'Sucorreo es: '.$email.<br>
        $msg.='Mensaje:<br>'.$message;

        $headers = 'MIME-Version:1.0\r\n';
        $headers .= 'Content-type:text/html; charset=UTF-8\r\n';
        $headers .= 'From: '.$name.'\r\n';
        $headers .= 'Reply-to :'.$email.'';

        $subject = "Cambiar contraseña en tiendamvc";

        return mail($email, $subject, $msg, $headers); //Enviando mail
    }
}
