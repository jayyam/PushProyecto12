<?php

/**
 * La clase application maneja la url y lanza los procesos
 */

class Application
{
    private $urlController = null;
    private $urlAction = null;
    private $urlParams = [];

    function __construct()
    {
        //print "Bienvenido a mi tienda virtual";
        //$db = Mysqldb::getInstance()->getDatabase();

       $this->separarURl();

        if ( ! $this->urlController ) {
            require_once '../app/controllers/LoginController.php';
            $page = new LoginController();
            $page->index();
        }
        elseif (file_exists('../app/controllers/' . ucfirst($this->urlController) . 'Controller.php')) {
            $controller = ucfirst($this->urlController) . 'Controller';
            require_once '../app/controllers/' . $controller . '.php';
            $this->urlController = new $controller;

            if (method_exists($this->urlController, $this->urlAction) &&
                is_callable(array($this->urlController, $this->urlAction))) {
                if ( ! empty($this->urlParams) ) {
                    call_user_func_array(array($this->urlController, $this->urlAction), $this->urlParams);
                } else {
                    $this->urlController->{$this->urlAction}();
                }
            }
            else {
                if (strlen($this->urlAction) == 0) {
                    $this->urlController->index();
                } else {
                    header('HTTP/1.0 404 Not Found');

                    // Tratamos el error producido cuando creemos el controlador de Error
                }
            }
        }else {
            require_once '../app/controllers/LoginController.php';
            $page = new LoginController();
            $page->index();
        }
    }

    public function separarURL()
    {
        if ($_SERVER['REQUEST_URI'] != '/')
        {
            $url = trim($_SERVER['REQUEST_URI'],  '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->urlController = isset($url[0]) ? $url[0] : null;
            /* $variable[0] ?? null;  --> Otro tipo de operador ternario reducido que hace lo de arriba */
            $this->urlAction = $url[1] ?? 1;

            unset($url[0], $url[1]);

            $this->urlParams = array_values($url);

            return $url;
        }
    }

}