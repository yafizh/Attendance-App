<?php

class Account extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('account/index');
        $this->view('templates/footer');
    }
}
