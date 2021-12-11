<?php

class Account extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('account/index');
        $this->view('templates/footer');
    }

    public function postChangePassword()
    {
        if ($this->model('AccountModel')->change($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('location: ' . BASEURL . '/account');
            exit;
        }else{
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('location: ' . BASEURL . '/account');
            exit;
        }

    }

}
