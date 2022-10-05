<?php

class AdminController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Admin');
    }

    public function index()
    {
        $data = ['titulo' => 'Admninistracion',
            'menu' => false,
            'data' => [],

        ];
        $this->view('admin/index', $data);
    }
    public function verifyuser()
    {
        $data = [
            'titulo' => 'Admninistracion - Inicio',
            'menu' => false,
            'admin' => true,
            'data' => [],
            ];
            $this->view('admin/index2', $data);
    }

}