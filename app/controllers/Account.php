<?php

class Account extends Controller
{
    public function index()
    {
        $this->view('templates/header');
        $this->view('account/index');
        $this->view('templates/footer');
    }

    public function changePassword()
    {
        if ($this->model('AccountModel')->putPassword($_POST) > 0) {
            Flasher::setFlash('Berhasil Mengubah Password', '', 'success');
            header('location: ' . BASEURL . '/account');
        } else {
            Flasher::setFlash('Gagal Mengubah Password', '', 'danger');
            header('location: ' . BASEURL . '/account');
        }
    }
}
