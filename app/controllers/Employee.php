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

    public function nip($nip)
    {
        $data = $this->model('HomeModel')->getAttendanceCodeToday();
        $this->view('templates/header');
        $this->view('employee/attendance_form', $data);
        $this->view('templates/footer');
    }

    public function presensi($nip)
    {
        if ($this->model('HomeModel')->getAttendanceCodeToday()["attendance_unique_code"] == strtoupper($_POST['absen_code'])) {
            $type = '';

            $data = $this->model('AttendanceModel')->getAttendanceToday($_SESSION['employee_id']);
            if ($data["PAGI"] == "00:00:00") {
                $type = "PAGI";
            } else {
                $type = "SORE";
            }
            $this->model('AttendanceModel')->putEmployeeAttendance($_SESSION['employee_id'], $type);
        } else {
            echo "kode salah";
        }
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
