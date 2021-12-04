<?php

class Home extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $data['generate_code'] = isset($_POST['generate_code']) ? true : false;
        $this->view('templates/header');
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
=======
        $this->view('templates/header');
        $this->view('home/index');
        $this->view('templates/footer');
    }

    public function addGenerate()
    {
        if ($_POST['generate_code'] == '') {
            header('location: ' . BASEURL . '/home');
            exit;
        } else {
            if ($this->model('home_model')->addGenerate($_POST) > 0) {
                header('location: ' . BASEURL . '/home');
                exit;
            }
        }
    }
>>>>>>> 5b18368 (login work and generate code)
}
