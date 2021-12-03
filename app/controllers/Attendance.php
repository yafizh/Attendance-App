<?php

class Attendance extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('attendance/index');
        $this->view('templates/footer');
    }
}
