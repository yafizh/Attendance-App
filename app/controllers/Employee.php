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
            header('location: ' . BASEURL . '/Employee');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('location: ' . BASEURL . '/Employee');
            exit;
        }
    }

    public function getEmployee()
    {
        echo json_encode($this->model('Employee_model')->getSingle($_POST['id']));
    }

    public function update()
    {
        if ($this->model('Employee_model')->update_employee($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('location: ' . BASEURL . '/Employee');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('location: ' . BASEURL . '/Employee');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('Employee_model')->delete_employee($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('location: ' . BASEURL . '/Employee');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('location: ' . BASEURL . '/Employee');
            exit;
        }
    }
}
