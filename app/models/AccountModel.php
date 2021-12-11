<?php

class AccountModel
{
    private $employee_table = 'employee_table';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function change($data)
    {
        $old_password = filter_input(INPUT_POST, 'old-password', FILTER_SANITIZE_STRING);
        $new_password = filter_input(INPUT_POST, 'new-password', FILTER_SANITIZE_STRING);
        $confirm_new_password = filter_input(INPUT_POST, 'confirm-new-password', FILTER_SANITIZE_STRING);
        
        $employee_unique_number = $_SESSION['employee_unique_number'];

        $query = "SELECT * FROM " . $this->employee_table . " WHERE employee_unique_number = '" . $employee_unique_number . "'";

        $this->db->query($query);        
        $this->db->execute();
        
        
        if($old_password == $this->db->single()['employee_password']){
            if ($new_password == $confirm_new_password) {
                $q = "UPDATE " . $this->employee_table . " SET employee_password = '" . $new_password . "' WHERE employee_unique_number = '" . $employee_unique_number . "'";
                $this->db->query($q);
                $this->db->execute();
            } else {
                return false;  
            }
        } else {
            return false;  
        }

    return $this->db->rowCount();
    }
}
