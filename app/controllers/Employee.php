<?php

class Employee extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('employee/index');
        $this->view('templates/footer');
    }

    public function name($name)
    {
        $this->view('templates/header');
        $this->view('employee/attendance_form');
    }
}
