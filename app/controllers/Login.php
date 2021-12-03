<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('login/index');
    }

    public function login_user()
    {
        $d = $this->model('Login_model')->getLogin();

        if ($d == 'login') {
            $_SESSION['login'] = 'admin';
            header('location: ' . BASEURL . '/Home');
        } else {
            $_SESSION['login'] = 'arya';
            header('location: ' . BASEURL . '/Employee/name/arya');
        }
    }
}
