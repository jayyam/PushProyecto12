<?php

class CourseController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('Course');
    }

    public function index()
    {
        $session = new Session();

        if ($session->getLogin()
    }
}