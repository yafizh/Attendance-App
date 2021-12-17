<?php
class Logout extends Controller
{
    public function index()
    {
        session_destroy();
        $this->view('logout/index');
    }
}
