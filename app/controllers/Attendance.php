<?php

class Attendance extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('attendance/index');
        $this->view('templates/footer');
    }

    public function getAllAttendace()
    {
        $this->view('templates/header');
        $this->view('attendance/all_employee_attendance');
        $this->view('templates/footer');
    }
}
