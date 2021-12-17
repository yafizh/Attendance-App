<?php

class Employee extends Controller
{
    public function index()
    {
        $data = $this->model('EmployeeModel')->getEmployees();
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

    public function postAttendance($nip)
    {
        if (
            $this->model('HomeModel')->getAttendanceCodeToday()["attendance_unique_code"] == strtoupper($_POST['absen_code'])
            &&
            $employee_id = $this->model('EmployeeModel')->getEmployeeIdByEmployeeNip($nip)["employee_id"]
        ) {
            $data = $this->model('AttendanceModel')->getAttendanceToday($employee_id);
            $type = ($data["PAGI"] == "00:00:00") ? "PAGI" : "SORE";

            if ($this->model('AttendanceModel')->putEmployeeAttendance($employee_id, $type) > 0) {
                header('location: ' . BASEURL . '/Employee/nip/' . $nip);
                exit;
            } else {
                header('location: ' . BASEURL . '/Employee/nip/' . $nip);
                exit;
            }
        } else {
            echo "kode salah";
        }
    }

    public function addEmployee()
    {
        if ($this->model('EmployeeModel')->add_employee($_POST) > 0) {
            Flasher::setFlash('Berhasil Menambahkan Data Karyawan', '', 'success');
            header('location: ' . BASEURL . '/Employee');
            exit;
        } else {
            Flasher::setFlash('Gagal Menambahkan Data Karyawan', '', 'danger');
            header('location: ' . BASEURL . '/Employee');
            exit;
        }
    }

    public function getEmployee()
    {
        echo json_encode($this->model('EmployeeModel')->getSingle($_POST['id']));
    }

    public function updateEmployee()
    {
        if ($this->model('EmployeeModel')->update_employee($_POST) > 0) {
            Flasher::setFlash('Berhasil Mengedit Data Karyawan', '', 'success');
            header('location: ' . BASEURL . '/Employee');
            exit;
        } else {
            Flasher::setFlash('Gagal Mengedit Data Karyawan', '', 'danger');
            header('location: ' . BASEURL . '/Employee');
            exit;
        }
    }

    public function deleteEmployee($id)
    {
        if ($this->model('EmployeeModel')->delete_employee($id) > 0) {
            Flasher::setFlash('Berhasil Menghapus Data Karyawan', '', 'success');
            header('location: ' . BASEURL . '/Employee');
            exit;
        } else {
            Flasher::setFlash('Gagal Menghapus Data Karyawan', '', 'danger');
            header('location: ' . BASEURL . '/Employee');
            exit;
        }
    }
}
