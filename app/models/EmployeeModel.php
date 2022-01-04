<?php

class EmployeeModel
{
    private $table = 'employee_table';
    private $db;

    public function __construct()
    {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $this->db = new Database;
    }

    function uploadImg()
    {
        $namaFile = $_FILES['image']['name'];
        $ukuranFile = $_FILES['image']['size'];
        $error = $_FILES['image']['error'];
        $tmpName = $_FILES['image']['tmp_name'];

        // cek apakah tidak ada gambar yang diupload
        if ($error === 4) {
            echo "<script>
                        alert('pilih gambar terlebih dahulu!');
                    </script>";
            return false;
        }

        // cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);   // explode = memecah string menggunakan delimiter
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                        alert('yang anda upload bukan gambar!');
                    </script>";
            return false;
        }


        // cek jika ukurannya terlalu besar
        if ($ukuranFile > 1000000) {
            echo "<script>
                        alert('ukuran gambar terlalu besar');
                    </script>";
            return false;
        }

        // lulus pengecekan, gambar sia diupload
        // generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'img/profile_employee/' . $namaFileBaru);

        return $namaFileBaru;
    }

    public function postEmployee()
    {
        $gambar = $this->uploadImg();
        if (!$gambar) {
            return false;
        }

        $employee_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $employee_nip = filter_input(INPUT_POST, 'employee_nip', FILTER_SANITIZE_STRING);
        $employee_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $query = "
            INSERT INTO 
                employee_table (
                    employee_name, 
                    employee_nip, 
                    employee_password, 
                    employee_image, 
                    created_at, 
                    edited_at
                ) 
            VALUES (
                    :employee_name, 
                    :employee_nip, 
                    :employee_password, 
                    :employee_image, 
                    :created_at, 
                    :edited_at
            )";
        $this->db->query($query);
        $this->db->bind('employee_name', $employee_name);
        $this->db->bind('employee_nip', $employee_nip);
        $this->db->bind('employee_password', $employee_password);
        $this->db->bind('employee_image', $gambar);
        $this->db->bind('created_at', Date("Y-m-d"));
        $this->db->bind('edited_at', Date("Y-m-d"));
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function putEmployee()
    {
        $old_image = $_POST['old_image'];
        $image = (($_FILES['image']['error'] === 4)) ? $old_image : $this->uploadImg();

        $employee_id = $_POST['employee_id'];
        $employee_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $employee_nip = filter_input(INPUT_POST, 'employee_nip', FILTER_SANITIZE_STRING);
        $employee_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $query = "
            UPDATE 
                employee_table 
            SET 
                employee_name = :employee_name, 
                employee_nip = :employee_nip, 
                employee_password = :employee_password, 
                employee_image = :employee_image, 
                edited_at = :edited_at 
            WHERE 
                employee_id = :employee_id";

        $this->db->query($query);
        $this->db->bind('employee_id', $employee_id);
        $this->db->bind('employee_name', $employee_name);
        $this->db->bind('employee_nip', $employee_nip);
        $this->db->bind('employee_image', $image);
        $this->db->bind('employee_password', $employee_password);
        $this->db->bind('edited_at', Date("Y-m-d"));
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteEmployee($employee_id)
    {
        $query = "DELETE FROM " .  $this->table . " WHERE employee_id = :employee_id";
        $this->db->query($query);
        $this->db->bind('employee_id',  $employee_id);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getEmployees()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getEmployeeIdByEmployeeNip($nip)
    {
        $this->db->query('SELECT * FROM ' .  $this->table . ' WHERE employee_nip=:employee_nip');
        $this->db->bind('employee_nip', $nip);
        return $this->db->single();
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
        $this->db->query("SELECT * FROM employee_table");
        $employees = $this->db->resultSet();
        foreach ($employees as $index => $value) {
            $this->db->query("
                SELECT 
                    attendance_type, 
                    TIME(created_at) AS attendance_time 
                FROM 
                    employee_attendance_table 
                WHERE 
                    employee_id=" . $value['employee_id'] . " 
                    AND 
                    DATE(created_at)='" . Date("Y-m-d") . "'");
            $result = $this->db->resultSet();
            if (empty($result)) array_splice($employees, $index, 1);
            else {
                $employees[$index][$result[0]['attendance_type']] = $result[0]['attendance_time'];
                $employees[$index][$result[1]['attendance_type']] = $result[1]['attendance_time'];
            }
        }
        return $employees;
    }
}
