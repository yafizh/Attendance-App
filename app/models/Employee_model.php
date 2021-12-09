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
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date_today = Date("Y-m-d");
        $this->db->query("SELECT b.employee_name, b.employee_unique_number, 
        (SELECT TIME(employee_attendance_table.created_at)
            FROM employee_attendance_table INNER JOIN employee_table ON employee_table.employee_id=employee_attendance_table.employee_id WHERE employee_attendance_table.attendance_type='PAGI' AND employee_attendance_table.employee_id=a.employee_id AND DATE(employee_attendance_table.created_at)=DATE(b.created_at)) AS PAGI, 
        (SELECT TIME(employee_attendance_table.created_at)  
            FROM employee_attendance_table INNER JOIN employee_table ON employee_table.employee_id=employee_attendance_table.employee_id WHERE employee_attendance_table.attendance_type='SORE' AND employee_attendance_table.employee_id=a.employee_id AND DATE(employee_attendance_table.created_at)=DATE(b.created_at)) AS SORE
    FROM employee_attendance_table AS a INNER JOIN employee_table AS b ON a.employee_id=b.employee_id WHERE (DATE(a.created_at) = '$date_today') GROUP BY b.employee_id");
        return $this->db->resultSet();
    }
}
