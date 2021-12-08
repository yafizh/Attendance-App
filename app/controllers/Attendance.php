<?php

class Attendance extends Controller
{
    public function index()
    {
        $data['attemdamce_code_today'] = $this->model('Home_model')->getAttendanceCodeToday();
        $data["employee_data"] = $this->model('Employee_model')->getEmployeeAttendanceToday();
        $this->view('templates/header');
        $this->view('attendance/index', $data);
        $this->view('templates/footer');
    }

    public function getAllAttendance()
    {
        $this->view('templates/header');
        $this->view('attendance/all_employee_attendance');
        $this->view('templates/footer');
    }

    public function getMonthlyAttendance()
    {
        $this->view('templates/header');
        $this->view('attendance/monthly_attendance');
        $this->view('templates/footer');
    }
}
