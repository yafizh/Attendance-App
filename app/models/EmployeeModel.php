<?php

class EmployeeModel
{
    private $table = 'employee_table';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function postEmployee()
    {

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

        $gambar = uploadImg();
        if (!$gambar) {
            return false;
        }

        $employee_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $unique_number = filter_input(INPUT_POST, 'unique', FILTER_SANITIZE_STRING);
        $employee_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $created_at = date("Y-m-d");

        $query = "INSERT INTO employee_table (employee_name, employee_unique_number, employee_password, employee_image, created_at, edited_at) 
                VALUES (:employee_name, :unique_number, :employee_password, :employee_image, :created_at, :edited_at)";
        $this->db->query($query);
        $this->db->bind('employee_name', $employee_name);
        $this->db->bind('unique_number', $unique_number);
        $this->db->bind('employee_password', $employee_password);
        $this->db->bind('employee_image', $gambar);
        $this->db->bind('created_at', $created_at);
        $this->db->bind('edited_at', $created_at);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update_employee($data)
    {
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

        $old_image = $_POST['old_image'];
        if ($_FILES['image']['error'] === 4) {
            $image = $old_image;
        } else {
            $image = uploadImg();
        }

        $employee_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $unique_number = filter_input(INPUT_POST, 'unique', FILTER_SANITIZE_STRING);
        $employee_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $edited_at = date("Y-m-d");

        $query = "UPDATE employee_table SET employee_name = :employee_name, employee_unique_number = :unique_number, employee_password = :employee_password, employee_image = :employee_image, edited_at = :edited_at WHERE employee_id = :employee_id";

        $this->db->query($query);
        $this->db->bind('employee_id', $data['id']);
        $this->db->bind('employee_name', $employee_name);
        $this->db->bind('unique_number', $unique_number);
        $this->db->bind('employee_image', $image);
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

    public function getEmployeeIdByEmployeeNip($nip)
    {
        $this->db->query('SELECT * FROM ' .  $this->table . ' WHERE employee_unique_number=:employee_unique_number');
        $this->db->bind('employee_unique_number', $nip);
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
