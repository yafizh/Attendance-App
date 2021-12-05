<?php

class Employee extends Controller
{
    public function index()
    {
        $data = $this->model('Employee_model')->getAll();
        $this->view('templates/header');
        $this->view('employee/index', $data);
        $this->view('templates/footer');
    }

    public function name($name)
    {
        $this->view('templates/header');
        $this->view('employee/attendance_form');
        $this->view('templates/footer');
    }

    public function add_employee()
    {
        $this->view('templates/header');
        $this->view('employee/add_employee');
        $this->view('templates/footer');
    }

    public function add()
    {
        if ($this->model('Employee_model')->add_employee($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('location: ' . BASEURL . '/employee/add_employee');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('location: ' . BASEURL . '/employee/add_employee');
            exit;
        }
    }
}
