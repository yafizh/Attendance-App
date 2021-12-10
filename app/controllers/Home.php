<?php

class Home extends Controller
{
    public function index()
    {
        $data = $this->model('Home_model')->getAttendanceCodeToday();
        $this->view('templates/header');
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function addAttendanceCode()
    {
        $insertedId = (int)$this->model('home_model')->addGenerate($_POST)["LAST_INSERT_ID()"];
        if ($insertedId > 0) {
            $employees = $this->model('Employee_model')->getAll();
            foreach ($employees as $employee) {
                $this->model('AttendanceModel')->initAttendanceToday($employee['employee_id'], $insertedId, 'PAGI');
                $this->model('AttendanceModel')->initAttendanceToday($employee['employee_id'], $insertedId, 'SORE');
            }
            header('location: ' . BASEURL . '/home');
            exit;
        }
    }
}
