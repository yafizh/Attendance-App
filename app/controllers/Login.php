<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('login/index');
    }

    public function auth()
    {
        if ($_POST['username'] == 'admin') {
            if (!empty($this->model('LoginModel')->auth(true, $_POST))) {
                $_SESSION['login'] = 'admin';
                header('location: ' . BASEURL . '/Home');
                exit;
            }
        } else {
            $employee = $this->model('LoginModel')->auth(false, $_POST);
            if (!empty($employee)) {
                $_SESSION['login'] = $employee['employee_unique_number'];
                header('location: ' . BASEURL . '/Employee/nip/' . $employee['employee_unique_number']);
                exit;
            }
        }

        Flasher::setFlash('Username atau Password Salah', '', 'danger');
        header('location: ' . BASEURL . '/Login');
    }
}
