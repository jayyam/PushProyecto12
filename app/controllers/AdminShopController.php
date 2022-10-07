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

        if ($session->getlogin())
        {
            $data = ['titulo' => 'Bienvenido administracion tienda',
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