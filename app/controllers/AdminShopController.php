<?php

class AdminShopController extends Controller

{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('AdminShop');
    }
    public function index()
    {
        $session = new Session();

        if ($session->getLogin()) {
            $data = [
                'titulo' => 'Bienvenid@ a la administración de la tienda',
                'menu' => false,
                'admin' => true,
                'subtitle' => 'Administracion tienda',
                ];
            $this->view('admin/shop/index', $data);
        }
        else
        {
            header('LOCATION:' . ROOT . 'admin');
        }
    }
}
