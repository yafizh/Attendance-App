<?php

class AttendanceModel
{
    private $table = 'employee_attendance_table';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function initAttendanceToday($employee_id, $attendance_id, $attendance_type)
    {
        $query = "INSERT INTO employee_attendance_table (employee_id, attendance_id, attendance_type) 
                VALUES (:employee_id, :attendance_id, :attendance_type)";
        $this->db->query($query);
        $this->db->bind('employee_id', $employee_id);
        $this->db->bind('attendance_id', $attendance_id);
        $this->db->bind('attendance_type', $attendance_type);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function putEmployeeAttendance($employee_id, $type)
    {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date_today = Date("Y-m-d");
        $date_come = Date("Y-m-d H:i:s");
        $query = "UPDATE employee_attendance_table SET created_at='$date_come'
                    WHERE 
                        employee_id=:employee_id 
                    AND 
                        DATE(created_at)=:created_at 
                    AND 
                        attendance_type=:attendance_type";
        $this->db->query($query);
        $this->db->bind('employee_id', $employee_id);
        $this->db->bind('created_at', $date_today);
        $this->db->bind('attendance_type', $type);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getAttendanceToday($employee_id)
    {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $today = date("Y-m-d");

        $query = "SELECT b.employee_name, b.employee_unique_number, DATE(a.created_at),
            (SELECT TIME(employee_attendance_table.created_at)
                FROM employee_attendance_table INNER JOIN employee_table ON employee_table.employee_id=employee_attendance_table.employee_id WHERE employee_attendance_table.attendance_type='PAGI' AND employee_attendance_table.employee_id=a.employee_id AND DATE(employee_attendance_table.created_at)=DATE(b.created_at)) AS PAGI
        FROM employee_attendance_table AS a INNER JOIN employee_table AS b ON a.employee_id=b.employee_id WHERE a.employee_id=$employee_id AND (DATE(a.created_at) = '$today') AND a.attendance_type='PAGI'";
        $this->db->query($query);
        return $this->db->single();
    }

    public function getAttendance($employee_id)
    {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $month_now = date("m");
        $year_now = date("Y");

        $query = "SELECT b.employee_name, b.employee_unique_number, DATE(a.created_at),
            (SELECT TIME(employee_attendance_table.created_at)
                FROM employee_attendance_table INNER JOIN employee_table ON employee_table.employee_id=employee_attendance_table.employee_id WHERE employee_attendance_table.attendance_type='PAGI' AND employee_attendance_table.employee_id=a.employee_id AND DATE(employee_attendance_table.created_at)=DATE(b.created_at)) AS PAGI, 
            (SELECT TIME(employee_attendance_table.created_at)  
                FROM employee_attendance_table INNER JOIN employee_table ON employee_table.employee_id=employee_attendance_table.employee_id WHERE employee_attendance_table.attendance_type='SORE' AND employee_attendance_table.employee_id=a.employee_id AND DATE(employee_attendance_table.created_at)=DATE(b.created_at)) AS SORE
        FROM employee_attendance_table AS a INNER JOIN employee_table AS b ON a.employee_id=b.employee_id WHERE a.employee_id=$employee_id AND (MONTH(a.created_at) = '$month_now') AND (YEAR(a.created_at) = '$year_now') GROUP BY DATE(a.created_at)";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getMonthlyAttendance($month, $year)
    {
        $query = "SELECT b.employee_name, b.employee_unique_number, DATE(a.created_at),
        (SELECT TIME(employee_attendance_table.created_at)
            FROM employee_attendance_table INNER JOIN employee_table ON employee_table.employee_id=employee_attendance_table.employee_id WHERE employee_attendance_table.attendance_type='PAGI' AND employee_attendance_table.employee_id=a.employee_id AND DATE(employee_attendance_table.created_at)=DATE(a.created_at)) AS PAGI, 
        (SELECT TIME(employee_attendance_table.created_at)  
            FROM employee_attendance_table INNER JOIN employee_table ON employee_table.employee_id=employee_attendance_table.employee_id WHERE employee_attendance_table.attendance_type='SORE' AND employee_attendance_table.employee_id=a.employee_id AND DATE(employee_attendance_table.created_at)=DATE(a.created_at)) AS SORE
    FROM employee_attendance_table AS a INNER JOIN employee_table AS b ON a.employee_id=b.employee_id WHERE (MONTH(a.created_at) = '$month') AND (YEAR(a.created_at) = '$year') GROUP BY DATE(a.created_at), b.employee_id";
        $this->db->query($query);
        return $this->db->resultSet();
    }
}
