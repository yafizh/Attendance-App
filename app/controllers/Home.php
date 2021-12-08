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
        if ($this->model('home_model')->addGenerate($_POST) > 0) {
            header('location: ' . BASEURL . '/home');
            exit;
        }
    }
}
