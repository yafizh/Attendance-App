<?php

class LoginModel
{
    private $admin_table = "admin_table";
    private $employee_table = 'employee_table';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function auth($isAdmin)
    {
        if ($isAdmin) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $query = "
                        SELECT 
                            * 
                        FROM "
                . $this->admin_table . " 
                        WHERE 
                            admin_username=:username 
                            AND 
                            admin_password=:password";

            $this->db->query($query);
            $this->db->bind('username', $username);
            $this->db->bind('password', $password);
            $this->db->execute();

            return $this->db->single();
        } else {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            $query = "
                        SELECT 
                            * 
                        FROM "
                . $this->employee_table . " 
                        WHERE 
                            employee_unique_number=:employee_unique_number
                            AND
                            employee_password=:employee_password";

            $this->db->query($query);
            $this->db->bind('employee_unique_number', $username);
            $this->db->bind('employee_password', $password);
            $this->db->execute();

            $_SESSION['employee_unique_number'] = $username;

            return $this->db->single();
        }
    }
}
