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
        $data =//cargando en variable
            [
                'titulo' => 'Bienvenido a tienda',
                'menu' => false,

            ];
        $this->view('shop/index', $data);
    }

}