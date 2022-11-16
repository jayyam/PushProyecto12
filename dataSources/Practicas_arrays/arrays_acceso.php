<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>
<?php

	//Arrays sin definir keys 
	
	// Array de strings
   // $dias = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
	
    // Array de integers
   // $numeros = array(10, 20, 30, 40);
	
    // Array de 10 elementos, sin asignar valor
    //$nombres = array(10);
	
    // Array vacío, sin posiciones definidas:
    //$datos = array();
	
	//Sintaxis corta
	 $valores = [$num1=10, $num2=20, $num3=10, $num4=40, $num5=0, $activo=true, $pasivo=false];
	 echo (var_dump($valores));
	//Posición 3 del array dias, comienza en 0 
	//echo $dias[3];
	//echo "<p> </p>";
	
	//Posición 0 del array valores
	//echo $valores[0];
	//echo "<p> </p>";
	
	//var_dump($dias);
	//echo "<p> </p>";
	
	var_dump($valores);
	//echo "<p> </p>";
	
	
?>
</body>
</html>