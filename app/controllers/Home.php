<?php

class Home extends Controller
{
    public function index()
    {
        $data = $this->model('HomeModel')->getAttendanceCodeToday();
        $this->view('templates/header');
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function addAttendanceCode()
    {
        $insertedId = (int)$this->model('HomeModel')->postAttendanceCode($_POST)["lastInsertedId"];
        if ($insertedId > 0) {
            $employees = $this->model('EmployeeModel')->getEmployees();
            foreach ($employees as $employee) {
                $this->model('AttendanceModel')->initAttendanceToday($employee['employee_id'], $insertedId, 'PAGI');
                $this->model('AttendanceModel')->initAttendanceToday($employee['employee_id'], $insertedId, 'SORE');
            }
            header('location: ' . BASEURL . '/Home');
            exit;
        }
    }
}
