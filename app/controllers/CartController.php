<?php

class CartController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Cart');
    }

    public function addProduct($product_id, $user_id)
    {
        //var_dump($product_id, $user_id);

        $errors = [];

        if ($this->model->verifyProduct($product_id, $user_id) == false)
        {
            if ($this->model->addProduct($product_id, $user_id) == false)
            {
                array_push($errors,'Error al insertar al carrito');
            }
        }
        $this->index();
    }
}