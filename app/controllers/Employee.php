<?php

use function PHPSTORM_META\type;

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
        // check nip sekaligus mengambil employee_id
        if ($employee_id = $this->model('EmployeeModel')->getEmployeeIdByEmployeeNip($nip)["employee_id"]) {
            // check apakah dia punya data presensi hari ini atau tidak
            // apakah dia baru ditambahkan setelah code presensi dibuat atau sebelum
            if ($employee_attendance = $this->model('AttendanceModel')->getAttendanceToday($employee_id)) {
                $data = ($employee_attendance["PAGI"] == "00:00:00") ? "PAGI" : "SORE";
                $this->view('templates/header');
                $this->view('employee/attendance_form', $data);
                $this->view('templates/footer');
            } else {
                $data = [];
                $this->view('templates/header');
                $this->view('employee/attendance_form', $data);
                $this->view('templates/footer');
            }
        }
    }

    public function postAttendance($nip)
    {
        if (
            $this->model('HomeModel')->getAttendanceCodeToday()["attendance_unique_code"] == strtoupper($_POST['absen_code'])
            &&
            $employee_id = $this->model('EmployeeModel')->getEmployeeIdByEmployeeNip($nip)["employee_id"]
        ) {
            if (
                $this->model('AttendanceModel')->putEmployeeAttendance($employee_id, $_POST['attendance_type'])
                >
                0
            ) {
                Flasher::setFlash('Berhasil mengisi presensi', '', 'success');
                header('location: ' . BASEURL . '/Employee/nip/' . $nip);
                exit;
            }
        }

        Flasher::setFlash('Gagal mengisi presensi', '', 'danger');
        header('location: ' . BASEURL . '/Employee/nip/' . $nip);
    }

    public function addEmployee()
    {
        $isSuccess = $this->model('EmployeeModel')->postEmployee($_POST);
        if ($isSuccess > 0 && gettype($isSuccess) == "int") {
            Flasher::setFlash('Berhasil Menambahkan Data Karyawan', '', 'success');
            header('location: ' . BASEURL . '/Employee');
        } else if(gettype($isSuccess) == "string") {
            Flasher::setFlash('Gagal Menambahkan Data Karyawan', $isSuccess, 'danger');
            header('location: ' . BASEURL . '/Employee');
        } else {
            Flasher::setFlash('Gagal Menambahkan Data Karyawan', '', 'danger');
            header('location: ' . BASEURL . '/Employee');
        }
    }

    public function getEmployee()
    {
        echo json_encode($this->model('EmployeeModel')->getSingle($_POST['id']));
    }

    public function updateEmployee()
    {
        if ($this->model('EmployeeModel')->putEmployee($_POST) > 0) {
            Flasher::setFlash('Berhasil Mengedit Data Karyawan', '', 'success');
            header('location: ' . BASEURL . '/Employee');
        } else {
            Flasher::setFlash('Gagal Mengedit Data Karyawan', '', 'danger');
            header('location: ' . BASEURL . '/Employee');
        }
    }

    public function deleteEmployee($id)
    {
        if ($this->model('EmployeeModel')->deleteEmployee($id) > 0) {
            Flasher::setFlash('Berhasil Menghapus Data Karyawan', '', 'success');
            header('location: ' . BASEURL . '/Employee');
        } else {
            Flasher::setFlash('Gagal Menghapus Data Karyawan', '', 'danger');
            header('location: ' . BASEURL . '/Employee');
        }
    }
}
