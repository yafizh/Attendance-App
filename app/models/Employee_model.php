<?php

class Employee_model
{
    private $table = 'employee_table';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function add_employee($data)
    {
        $employee_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $employee_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $created_at = date("Y-m-d");

        $query = "INSERT INTO employee_table (employee_name, employee_password, created_at, edited_at) 
                VALUES (:employee_name, :employee_password, :created_at, :edited_at)";
        $this->db->query($query);
        $this->db->bind('employee_name', $employee_name);
        $this->db->bind('employee_password', $employee_password);
        $this->db->bind('created_at', $created_at);
        $this->db->bind('edited_at', $created_at);

        if ($this->db->execute()) {
            header('location: ' . BASEURL . '/employee/add_employee');
        }

        return $this->db->rowCount();
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getEmployeeAttendanceToday()
    {
        $this->db->query("SELECT eeeee.*, 
        (SELECT TIME(employee_attendance_table.created_at)
            FROM employee_table LEFT JOIN employee_attendance_table ON employee_table.employee_id=employee_attendance_table.employee_id WHERE employee_attendance_table.attendance_type='PAGI' AND employee_attendance_table.employee_id=eeeee.employee_id) AS PAGI, 
        (SELECT TIME(employee_attendance_table.created_at)  
            FROM employee_table LEFT JOIN employee_attendance_table ON employee_table.employee_id=employee_attendance_table.employee_id WHERE employee_attendance_table.attendance_type='SORE' AND employee_attendance_table.employee_id=eeeee.employee_id) AS SORE
         FROM employee_table AS eeeee LEFT JOIN employee_attendance_table ON eeeee.employee_id=employee_attendance_table.employee_id GROUP BY eeeee.employee_id");
        return $this->db->resultSet();
    }
}
