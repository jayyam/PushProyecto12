<?php

class ShopController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Shop');//cada control lleva asociado un modelo
    }
    public function index()
    {
        $session = new Session();

        if ($session->getLogin())
        {
            $data = [
                'titulo' => 'Bienvenid@ a nuestra tienda',
                'menu' => false,
            ];
            $this->view('shop/index', $data);
        }
        else
        {
            header('location:' . ROOT);
        }
    }
}
