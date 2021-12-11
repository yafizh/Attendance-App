<?php

class Login_model
{
    private $table = 'employee_table';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function loginAdmin()
    {
        if (isset($_REQUEST['employee_unique_number']) && ($_REQUEST['password'])) {
            if ($_REQUEST['employee_unique_number'] == 'admin' && $_REQUEST['password'] == 'admin') {
                return 'login';
            } else {
                return 'invalid user';
            }
        }
    }
    public function login($data)
    {
        $employee_unique_number = filter_input(INPUT_POST, 'employee_unique_number', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $query = "SELECT * FROM " . $this->table . " WHERE employee_unique_number=:employee_unique_number";

        $this->db->query($query);
        $this->db->bind('employee_unique_number', $employee_unique_number);
        $this->db->execute();

        $user = $this->db->single();
        if ($employee_unique_number == $user['employee_unique_number']) {
            if ($password == $user["employee_password"]) {
                $_SESSION['employee_id'] = $user['employee_id'];
                $_SESSION['employee_unique_number'] = $user['employee_unique_number'];
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
}
