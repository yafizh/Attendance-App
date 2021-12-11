<?php

class HomeModel
{
    private $table = 'attendance_table';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function postAttendanceCode()
    {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $attendance_code = filter_input(INPUT_POST, 'attendance_code', FILTER_SANITIZE_STRING);
        $created_at = date("Y-m-d");

        $query = "
                    INSERT INTO 
                        attendance_table (
                            attendance_unique_code, 
                            created_at, 
                            edited_at
                        ) 
                    VALUES (
                            :attendance_unique_code, 
                            :created_at, 
                            :edited_at
                        )";
        $this->db->query($query);
        $this->db->bind('attendance_unique_code', $attendance_code);
        $this->db->bind('created_at', $created_at);
        $this->db->bind('edited_at', $created_at);
        $this->db->execute();

        $this->db->query("SELECT LAST_INSERT_ID() AS lastInsertedId");
        return $this->db->single();
    }

    public function getAttendanceCodeToday()
    {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $today = Date('Y-m-d');
        $this->db->query("SELECT * FROM " . $this->table . " WHERE created_at='$today'");
        return $this->db->single();
    }
}
