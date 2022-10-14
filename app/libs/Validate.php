<?php

class Validate
{
    public static function number($string)
    {
        $search = [' ', '$', ',', 'SymboloEuro'];
        $replace = ['','','',''];

        $number = str_replace($search, $replace, $string);// funcion que cambia los parametros definidos en $string. Uno busca y el otro reemplaza
        //rearreglabe
        return $number;
    }

    public static function date($string)
    {
        $date = explode('-', $string);
        return checkdate($date[1],$date[2],$date[0]);//obteniendo array con informacion del datePicker en AÑO/MES/DIA y reordenandola
    }

    public static function dateDif($string)
    {
       $now = new DateTime();
       $date =  new DateTime($string);

       return ($date>$now);//simple comparacion de fechas

    }
    public static function file($string)
    {

    }
}