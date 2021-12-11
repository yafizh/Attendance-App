<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('login/index');
    }

    public function login_user()
    {
        if ($_POST['employee_unique_number'] == 'admin') {
            $d = $this->model('Login_model')->loginAdmin();

            if ($d == 'login') {
                $_SESSION['login'] = 'admin';
                $_SESSION['employee_id'] = 'admin';
                header('location: ' . BASEURL . '/Home');
            }
        } else {
            if ($this->model('login_model')->login($_POST) > 0) {
                $_SESSION['login'] = $_POST['employee_unique_number'];
                header('location: ' . BASEURL . '/Employee/nip/' . $_POST['employee_unique_number']);
                exit;
            } else {
                Flasher::setFlash('employee_unique_number atau password', 'invalid', 'danger');
                header('location: ' . BASEURL . '/login');
                exit;
            }
        }
    }
}
