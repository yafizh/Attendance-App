<?php

class Home_model
{
    private $table = 'attendance_table';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function addGenerate()
    {
        $generate_code = filter_input(INPUT_POST, 'generate_code', FILTER_SANITIZE_STRING);
        $created_at = date("Y/m/d");

        $query = "INSERT INTO attendance_table (attendance_unique_code, created_at, edited_at) 
                VALUES (:attendance_unique_code, :created_at, :edited_at)";
        $this->db->query($query);
        $this->db->bind('attendance_unique_code', $generate_code);
        $this->db->bind('created_at', $created_at);
        $this->db->bind('edited_at', $created_at);

        if ($this->db->execute()) {
            header('location: ' . BASEURL . '/home');
        }

        return $this->db->rowCount();
    }

    public function getAllUser()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
}
