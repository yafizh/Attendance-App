<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('login/index');
    }

    public function login_user()
    {
<<<<<<< HEAD
        $d = $this->model('Login_model')->getLogin();

        if ($d == 'login') {
            $_SESSION['login'] = 'admin';
            header('location: ' . BASEURL . '/Home');
        } else {
            $_SESSION['login'] = 'arya';
            header('location: ' . BASEURL . '/Employee/name/arya');
=======
        if ($_POST['username'] == 'admin') {
            $d = $this->model('Login_model')->loginAdmin();

            if ($d == 'login') {
                $_SESSION['login'] = 'admin';
                $_SESSION['employee_id'] = 'admin';
                header('location: ' . BASEURL . '/Home');
            }
        } else {
            if ($this->model('login_model')->login($_POST) > 0) {
                $_SESSION['login'] = $_POST['username'];
                header('location: ' . BASEURL . '/Employee/name/' . $_POST['username']);
                exit;
            } else {
                Flasher::setFlash('username atau password', 'invalid', 'danger');
                header('location: ' . BASEURL . '/login');
                exit;
            }
>>>>>>> 5b18368 (login work and generate code)
        }
    }
}
