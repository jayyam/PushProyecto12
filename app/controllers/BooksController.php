<?php

class BooksController extends Controller

{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Books');
    }

    public function index()
    {
        $session = new Session();

        if ($session->getLogin())
        {

        }
    }

}