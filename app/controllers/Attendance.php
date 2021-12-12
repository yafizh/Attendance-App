<?php

class Attendance extends Controller
{
    public function index()
    {
        $data['attendance_code'] = $this->model('HomeModel')->getAttendanceCodeToday();
        $data["employee_data"] = $this->model('EmployeeModel')->getEmployeeAttendanceToday();
        $this->view('templates/header');
        $this->view('attendance/index', $data);
        $this->view('templates/footer');
    }

    public function getAllAttendance()
    {
        $data = $this->model('EmployeeModel')->getEmployees();
        $this->view('templates/header');
        $this->view('attendance/all_employee_attendance', $data);
        $this->view('templates/footer');
    }

    public function getMonthlyAttendance()
    {
        $this->view('templates/header');
        $this->view('attendance/monthly_attendance');
        $this->view('templates/footer');
    }

    public function getMonthlyAttendanceData()
    {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $month_now = date("m");
        $year_now = date("Y");
        $data = $this->model('AttendanceModel')->getMonthlyAttendance($month_now, $year_now);
        echo json_encode($data);
    }

    public function attendanceHistory($employee_id)
    {
        $data = $this->model('AttendanceModel')->getAttendanceHistory($employee_id);
        echo json_encode($data);
    }
}
