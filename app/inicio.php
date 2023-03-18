<?php

ini_set('display_errors', 1);

// Constantes iniciales
define('ROOT', DIRECTORY_SEPARATOR); // slash =(/)= raiz
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR); // slash/carpetaDeAplicacion/slash
define('URL', '/var/www/proyecto12/');
define('VIEWS', URL.APP.'views/');
define('ENCRIPTKEY', 'elperrodesanroque'); //constante que contiene la clave de encriptacion del password


//carga las clases iniciales

require_once('libs/Mysqldb.php');
require_once('libs/Controller.php');
require_once('libs/Application.php');
require_once ('libs/Session.php');
require_once ('libs/SessionAdmin.php');
require_once('libs/Validate.php');


