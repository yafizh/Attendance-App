<?php

class EmployeeModel
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
        $unique_number = filter_input(INPUT_POST, 'unique', FILTER_SANITIZE_STRING);
        $employee_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $created_at = date("Y-m-d");

        $query = "INSERT INTO employee_table (employee_name, employee_unique_number, employee_password, created_at, edited_at) 
                VALUES (:employee_name, :unique_number, :employee_password,  :created_at, :edited_at)";
        $this->db->query($query);
        $this->db->bind('employee_name', $employee_name);
        $this->db->bind('unique_number', $unique_number);
        $this->db->bind('employee_password', $employee_password);
        $this->db->bind('created_at', $created_at);
        $this->db->bind('edited_at', $created_at);

        if ($this->db->execute()) {
            header('location: ' . BASEURL . '/employee/add_employee');
        }

        return $this->db->rowCount();
    }

    public function update_employee($data)
    {
        $employee_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $unique_number = filter_input(INPUT_POST, 'unique', FILTER_SANITIZE_STRING);
        $employee_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $edited_at = date("Y-m-d");

        $query = "UPDATE employee_table SET employee_name = :employee_name, employee_unique_number = :unique_number, employee_password = :employee_password, edited_at = :edited_at WHERE employee_id = :employee_id";

        $this->db->query($query);
        $this->db->bind('employee_id', $data['id']);
        $this->db->bind('employee_name', $employee_name);
        $this->db->bind('unique_number', $unique_number);
        $this->db->bind('employee_password', $employee_password);
        $this->db->bind('edited_at', $edited_at);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete_employee($id)
    {
        $query = "DELETE FROM " .  $this->table . " WHERE employee_id = :id";
        $this->db->query($query);
        $this->db->bind('id',  $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getEmployees()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getSingle($id)
    {
        $this->db->query('SELECT * FROM ' .  $this->table . ' WHERE employee_id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getEmployeeAttendanceToday()
    {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date_today = Date("Y-m-d");
        $this->db->query("SELECT * FROM employee_table");
        $employees = $this->db->resultSet();
        foreach ($employees as $index => $value) {
            $this->db->query("SELECT attendance_type, TIME(created_at) AS attendance_time FROM employee_attendance_table WHERE employee_id=" . $value['employee_id'] . " AND DATE(created_at)='" . $date_today . "'");
            $result = $this->db->resultSet();
            if (empty($result)) {
                $employees[$index]['PAGI'] = null;
                $employees[$index]['SORE'] = null;
            } else {
                if (count($result) == 2) {
                    $employees[$index][$result[0]['attendance_type']] = $result[0]['attendance_time'];
                    $employees[$index][$result[1]['attendance_type']] = $result[1]['attendance_time'];
                } else {
                    $employees[$index][$result[0]['attendance_type']] = $result[0]['attendance_time'];
                    $employees[$index]["SORE"] = null;
                }
            }
        }
        return $employees;
    }
}
