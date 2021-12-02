<?php

class Login_model
{
    private $table = 'employee_table';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function getLogin()
    {
        if (isset($_REQUEST['username']) && ($_REQUEST['password'])) {
            if ($_REQUEST['username'] == 'admin' && $_REQUEST['password'] == 'admin') {
                return 'login';
            } else {
                return 'invalid user';
            }
        }
    }
}
