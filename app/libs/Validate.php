<?php

class Validate
{
    public static function number($string)
    {
        $search = [' ', 'Euro','$', ',' ];
        $replace = ['','','',''];

        $number = str_replace($search, $replace, $string);// funcion que cambia los parametros definidos en $string. Uno busca y el otro reemplaza
        //rearreglabe
        return $number;
    }

    public static function date($string)
    {
        $date = explode('-', $string);
        if (count($date) == 1) {
            return false;
        }

        return checkdate($date[1], $date[2], $date[0]);
    }

    public static function dateDif($string)
    {
       $now = new DateTime();
       $date =  new DateTime($string);

       return ($date>$now);//simple comparacion de fechas

    }
    public static function file($string)
    {
        $search = [' ', '*', '!', '@', '?', 'á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ', 'ü', 'Ü', '¿', '¡'];
        $replace = ['-', '', '', '', '', 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'n', 'N', 'u', 'U', '', ''];
        $file = str_replace($search,$replace, $string);

        return $file;
    }

    public static function resizeImage($image, $newWidth)
    {
        $file = 'img'.$image;

        $info = getimagesize($file);//funcion que de vuelve una array numerico referente a anchura y altura
        $width = $info[0];
        $height = $info[1];
        $type = $info['mime'];

        $factor = $newWidth/$width;
        $newHeight = $factor * $height;

        $image = imagecreatefromjpeg($file);

        $canvas = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled($canvas, $image, 0,0,0,0, $newWidth, $newHeight, $width, $height);
        //punto 0,0 de imagen corresponde con 0,0 canvas (esquina superior izquierda de la pantalla)
        //Redimensionamiento de imagen
        imagejpeg($canvas, $file, 80);
    }
    public static function text($string)
    {
        $search = ['^', 'delete', 'drop', 'truncate', 'exec', 'system'];
        $replace = ['-', 'dele*te', 'dr*op', 'trunca*te', 'ex*ec', 'syst*em'];
        $string = str_replace($search, $replace, $string);
        $string = addslashes(htmlentities($string));

        return $string;
    }
    public static function imageFile($file)//arreglar. se esta tratando de obtener imagenes de un dato null. Hay que comprobar que no se le pasa null
    {
        $imageArray = getimagesize($file);
        $imageType = $imageArray[2];

        return (bool) (in_array($imageType, [IMAGETYPE_JPEG, IMAGETYPE_PNG]));
    }
}
