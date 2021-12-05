<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_app_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "
    DROP DATABASE IF EXISTS " . $dbname . ";
    CREATE DATABASE " . $dbname;
echo ($conn->multi_query($sql) === TRUE) ? ("Database created successfully<br>") : ("Error creating database: " . $conn->error);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
    DROP TABLE IF EXISTS employee_table; 
    CREATE TABLE employee_table (
        employee_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        employee_name VARCHAR(255) NOT NULL,
        employee_unique_number VARCHAR(255) NOT NULL,
        employee_password VARCHAR(255) NOT NULL,
        created_at DATE NOT NULL,
        edited_at DATE NOT NULL
    )";

echo ($conn->multi_query($sql) === TRUE) ? ("Table employee_table created successfully<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}

$sql = "
    INSERT INTO employee_table (
        employee_id,
        employee_name,
        employee_unique_number,
        employee_password,
        created_at,
        edited_at
    ) VALUES 
        (null, 'Nursahid Arya Suyudi', '18636655', 'arya', CURDATE(), CURDATE())";

echo ($conn->multi_query($sql) === TRUE) ? ("Table employee_table inserted successfully<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}

$sql = "
    DROP TABLE IF EXISTS attendance_table; 
    CREATE TABLE attendance_table (
        attendance_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        attendance_unique_code VARCHAR(255) NOT NULL,
        created_at DATE NOT NULL,
        edited_at DATE NOT NULL
    )";

echo ($conn->multi_query($sql) === TRUE) ? ("Table employee_table created successfully<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}

$sql = "
    DROP TABLE IF EXISTS employee_attendance_table; 
    CREATE TABLE employee_attendance_table (
        employee_attendance_id INT UNSIGNED AUTO_INCREMENT,
        employee_id INT NOT NULL,
        attendance_id INT NOT NULL,
        created_at DATE NOT NULL,
        PRIMARY KEY (employee_attendance_id),
        FOREIGN KEY (employee_id) REFERENCES employee_table (employee_id),
        FOREIGN KEY (attendance_id) REFERENCES attendance_table (attendance_id)
    )";

echo ($conn->multi_query($sql) === TRUE) ? ("Table employee_attendance_table created successfully<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}

$conn->close();
