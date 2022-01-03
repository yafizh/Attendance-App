<?php

class AttendanceModel
{
    private $table = 'employee_attendance_table';
    private $db;

    public function __construct()
    {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $this->db = new Database;
    }

    public function initAttendanceToday($employee_id, $attendance_id, $attendance_type)
    {
        $query = "
                    INSERT INTO "
            . $this->table . " (
                            employee_id, 
                            attendance_id, 
                            attendance_type,
                            created_at
                        ) 
                    VALUES (
                            :employee_id, 
                            :attendance_id, 
                            :attendance_type,
                            :created_at
                        )";
        $this->db->query($query);
        $this->db->bind('employee_id', $employee_id);
        $this->db->bind('attendance_id', $attendance_id);
        $this->db->bind('attendance_type', $attendance_type);
        $this->db->bind('created_at', (Date("Y-m-d") . ' ' . '00:00:00'));
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function putEmployeeAttendance($employee_id, $type)
    {
        $query = "UPDATE employee_attendance_table SET created_at='" . Date("Y-m-d H:i:s") . "'
                    WHERE 
                        employee_id=:employee_id 
                    AND 
                        DATE(created_at)=:created_at 
                    AND 
                        attendance_type=:attendance_type";
        $this->db->query($query);
        $this->db->bind('employee_id', $employee_id);
        $this->db->bind('created_at', Date("Y-m-d"));
        $this->db->bind('attendance_type', $type);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getAttendanceToday($employee_id)
    {
        $query = "
            SELECT 
                * 
            FROM 
                attendance_today_view  
            WHERE 
                employee_id=$employee_id 
                AND 
                created_at = '" . Date("Y-m-d") . "' 
                AND 
                attendance_type='PAGI'";
        $this->db->query($query);
        return $this->db->single();
    }

    public function getAttendanceHistory($employee_id)
    {
        $query = "
            SELECT 
                * 
            FROM 
                attendance_history_view 
            WHERE 
                employee_id=$employee_id 
            GROUP BY 
                attendance_date";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getMonthlyAttendance()
    {
        $query = "
            SELECT 
                * 
            FROM 
                monthly_attendance_view  
            GROUP BY 
                attendance_date, employee_id";

        $this->db->query($query);
        return $this->db->resultSet();
    }
}
