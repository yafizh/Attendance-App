<?php

class Attendance extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('attendance/index');
        $this->view('templates/footer');
    }

    public function getAllAttendance()
    {
        $this->view('templates/header');
        $this->view('attendance/all_employee_attendance');
        $this->view('templates/footer');
    }

    public function getMonthlyAttendance()
    {
        $this->view('templates/header');
        $this->view('attendance/monthly_attendance');
        $this->view('templates/footer');
    }
}
