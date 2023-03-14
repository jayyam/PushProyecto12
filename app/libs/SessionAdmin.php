<?php

class SessionAdmin
{
    private $login = false;
    private $user;
    //private $cartTotal;

    public function __construct()
    {
        session_start();

        if (isset($_SESSION['admin']))
        {
            $this->user =$_SESSION['admin'];
            $this->login =true;
            //$_SESSION['cartTotal'] = $this->cartTotal();
            //$this->cartTotal = $_SESSION['cartTotal'];
        }
        else
        {
            unset($this->user);
            $this->login=false;
        }
    }
    public function login($user) :void
    {
        if ($user)
        {
            $this->user = $user;
            $_SESSION['admin'] = $user;
            $this->login = true;
        }
    }
    public function logout() :void
    {
        unset($_SESSION['admin']);
        unset($this->user);
        session_destroy();
        $this->login = false;
    }

    public function redirectIfNotLogin($route)
    {
        if (!$this->login) {
            header('location:' . $route);
        }
    }

    public function getLogin() :bool
    {
        return $this->login;
    }

    public function getUser()
    {
        return $this->user;
    }
    public function getUserId()
    {
        return $this->user->id;
    }
}
