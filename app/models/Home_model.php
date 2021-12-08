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
        $code_today = filter_input(INPUT_POST, 'code_today', FILTER_SANITIZE_STRING);
        $created_at = date("Y-m-d");

        $query = "INSERT INTO attendance_table (attendance_unique_code, created_at, edited_at) 
                VALUES (:attendance_unique_code, :created_at, :edited_at)";
        $this->db->query($query);
        $this->db->bind('attendance_unique_code', $code_today);
        $this->db->bind('created_at', $created_at);
        $this->db->bind('edited_at', $created_at);

        if ($this->db->execute()) {
            header('location: ' . BASEURL . '/home');
        }

        return $this->db->rowCount();
    }

    public function getAttendanceCodeToday()
    {
        $today = Date('Y-m-d');
        $this->db->query("SELECT * FROM " . $this->table . " WHERE created_at='$today'");
        return $this->db->resultSet();
    }
}
