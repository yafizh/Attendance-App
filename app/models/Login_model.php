<?php

class Login_model
{
    private $table = 'employee_table';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

<<<<<<< HEAD

    public function getLogin()
=======
    public function loginAdmin()
>>>>>>> 5b18368 (login work and generate code)
    {
        if (isset($_REQUEST['username']) && ($_REQUEST['password'])) {
            if ($_REQUEST['username'] == 'admin' && $_REQUEST['password'] == 'admin') {
                return 'login';
            } else {
                return 'invalid user';
            }
        }
    }
<<<<<<< HEAD
=======

    public function login($data)
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $query = "SELECT * FROM " . $this->table . " WHERE employee_name=:username";

        $this->db->query($query);
        $this->db->bind('username', $username);
        $this->db->execute();

        $user = $this->db->single();
        if ($username == $user['employee_name']) {
            if ($password == $user["employee_password"]) {
                $_SESSION['employee_id'] = $user['employee_id'];
                $_SESSION['employee_name'] = $user['employee_name'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

        return $this->db->rowCount();
    }

    public function getAllUser()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
>>>>>>> 5b18368 (login work and generate code)
}
