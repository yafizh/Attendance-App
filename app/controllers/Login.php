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
            header('location: ' . BASEURL . '/Home');
        } else {
            header('location: ' . BASEURL . '/login');
        }
    }
}
