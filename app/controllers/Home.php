<?php

class Home extends Controller
{
    public function index()
    {
        $data['generate_code'] = isset($_POST['generate_code']) ? true : false;
        $this->view('templates/header');
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}
