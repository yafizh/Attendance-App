<?php

class Attendance extends Controller
{
    public function index()
    {
        $data['attendance_code_today'] = $this->model('Home_model')->getAttendanceCodeToday();
        $data["employee_data"] = $this->model('Employee_model')->getEmployeeAttendanceToday();
        $this->view('templates/header');
        $this->view('attendance/index', $data);
        $this->view('templates/footer');
    }

    public function getAllAttendance()
    {
        $data = $this->model('Employee_model')->getAll();
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

    public function detail($employee_id)
    {
        $data = $this->model('AttendanceModel')->getAttendance($employee_id);
        echo json_encode($data);
    }
}
