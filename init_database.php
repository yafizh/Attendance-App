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
    DROP TABLE IF EXISTS admin_table; 
    CREATE TABLE admin_table (
        admin_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        admin_username VARCHAR(255) NOT NULL,
        admin_password VARCHAR(255) NOT NULL
    )";

echo ($conn->multi_query($sql) === TRUE) ? ("1<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}

$sql = "
    INSERT INTO admin_table (
        admin_id,
        admin_username,
        admin_password
    ) VALUES 
        (null, 'admin', 'admin')";

echo ($conn->multi_query($sql) === TRUE) ? ("2<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}

$sql = "
    DROP TABLE IF EXISTS employee_table; 
    CREATE TABLE employee_table (
        employee_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        employee_name VARCHAR(255) NOT NULL,
        employee_nip VARCHAR(255) UNIQUE NOT NULL,
        employee_password VARCHAR(255) NOT NULL,
        employee_image VARCHAR(100) NOT NULL,
        created_at DATE NOT NULL,
        edited_at DATE NOT NULL
    )";

echo ($conn->multi_query($sql) === TRUE) ? ("3<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}

$sql = "
    INSERT INTO employee_table (
        employee_id,
        employee_name,
        employee_nip,
        employee_password,
        employee_image,
        created_at,
        edited_at
    ) VALUES 
        (null, 'Nursahid Arya Suyudi', '18636655', 'arya','default.png', CURDATE(), CURDATE()),
        (null, 'Nurcholis', '18636666', 'cholis','default.png', CURDATE(), CURDATE()),
        (null, 'Diki Suti Praserta', '18636677', 'diki','default.png', CURDATE(), CURDATE()),
        (null, 'Ibrahim', '18636688', 'ibrahim','default.png', CURDATE(), CURDATE()),
        (null, 'Udin', '18636699', 'udin','default.png', CURDATE(), CURDATE()),
        (null, 'Rania Nor Aida', '18635510', 'Rania','default.png', CURDATE(), CURDATE())";

echo ($conn->multi_query($sql) === TRUE) ? ("4<br>") : ("Error creating table: " . $conn->error);
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

echo ($conn->multi_query($sql) === TRUE) ? ("5<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}

$sql = "
    INSERT INTO attendance_table (
        attendance_id,
        attendance_unique_code,
        created_at,
        edited_at
    ) VALUES 
        (null, 'KLMNAS', CURDATE(), CURDATE())";

echo ($conn->multi_query($sql) === TRUE) ? ("6<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}

$sql = "
    DROP TABLE IF EXISTS employee_attendance_table; 
    CREATE TABLE employee_attendance_table (
        employee_attendance_id INT UNSIGNED AUTO_INCREMENT,
        employee_id INT UNSIGNED NOT NULL,
        attendance_id INT UNSIGNED NOT NULL,
        attendance_type ENUM('PAGI','SORE') NOT NULL,
        created_at DATETIME NULL,
        PRIMARY KEY (employee_attendance_id),
        FOREIGN KEY (employee_id) REFERENCES employee_table (employee_id) ON DELETE CASCADE,
        FOREIGN KEY (attendance_id) REFERENCES attendance_table (attendance_id) ON DELETE CASCADE
    )";

echo ($conn->multi_query($sql) === TRUE) ? ("7<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}


$sql = "
    INSERT INTO employee_attendance_table (
        employee_attendance_id,
        employee_id,
        attendance_id,
        attendance_type,
        created_at 
    ) VALUES
        (null, 1, 1, 'PAGI', CONCAT(CURRENT_DATE() - INTERVAL 1 MONTH,' ','07:00:00')),
        (null, 1, 1, 'SORE', CONCAT(CURRENT_DATE() - INTERVAL 1 MONTH,' ','16:00:00')),
        (null, 2, 1, 'PAGI', CONCAT(CURRENT_DATE() - INTERVAL 1 MONTH,' ','07:30:00')),
        (null, 2, 1, 'SORE', CONCAT(CURRENT_DATE() - INTERVAL 1 MONTH,' ','16:30:00')),
        (null, 1, 1, 'PAGI', CONCAT(CURRENT_DATE() - INTERVAL 1 DAY,' ','08:00:00')),
        (null, 1, 1, 'SORE', CONCAT(CURRENT_DATE() - INTERVAL 1 DAY,' ','16:00:00')),
        (null, 2, 1, 'PAGI', CONCAT(CURRENT_DATE() - INTERVAL 1 DAY,' ','07:30:00')),
        (null, 2, 1, 'SORE', CONCAT(CURRENT_DATE() - INTERVAL 1 DAY,' ','00:00:00')),
        (null, 3, 1, 'PAGI', CONCAT(CURRENT_DATE() - INTERVAL 1 DAY,' ','00:00:00')),
        (null, 3, 1, 'SORE', CONCAT(CURRENT_DATE() - INTERVAL 1 DAY,' ','00:00:00')),
        (null, 4, 1, 'PAGI', CONCAT(CURRENT_DATE() - INTERVAL 1 DAY,' ','08:00:00')),
        (null, 4, 1, 'SORE', CONCAT(CURRENT_DATE() - INTERVAL 1 DAY,' ','16:00:00')),
        (null, 5, 1, 'PAGI', CONCAT(CURRENT_DATE() - INTERVAL 1 DAY,' ','07:30:00')),
        (null, 5, 1, 'SORE', CONCAT(CURRENT_DATE() - INTERVAL 1 DAY,' ','00:00:00')),
        (null, 6, 1, 'PAGI', CONCAT(CURRENT_DATE() - INTERVAL 1 DAY,' ','00:00:00')),
        (null, 6, 1, 'SORE', CONCAT(CURRENT_DATE() - INTERVAL 1 DAY,' ','00:00:00')),
        (null, 1, 1, 'PAGI', CONCAT(CURRENT_DATE(),' ','00:00:00')),
        (null, 1, 1, 'SORE', CONCAT(CURRENT_DATE(),' ','00:00:00')),
        (null, 2, 1, 'PAGI', CONCAT(CURRENT_DATE(),' ','07:30:00')),
        (null, 2, 1, 'SORE', CONCAT(CURRENT_DATE(),' ','16:30:00')),
        (null, 3, 1, 'PAGI', CONCAT(CURRENT_DATE(),' ','07:00:00')),
        (null, 3, 1, 'SORE', CONCAT(CURRENT_DATE(),' ','16:00:00')),
        (null, 4, 1, 'PAGI', CONCAT(CURRENT_DATE(),' ','07:30:00')),
        (null, 4, 1, 'SORE', CONCAT(CURRENT_DATE(),' ','16:30:00')),
        (null, 5, 1, 'PAGI', CONCAT(CURRENT_DATE(),' ','08:00:00')),
        (null, 5, 1, 'SORE', CONCAT(CURRENT_DATE(),' ','16:00:00')),
        (null, 6, 1, 'PAGI', CONCAT(CURRENT_DATE(),' ','08:30:00')),
        (null, 6, 1, 'SORE', CONCAT(CURRENT_DATE(),' ','16:30:00'))";

echo ($conn->multi_query($sql) === TRUE) ? ("8<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}

$sql = "
    DROP VIEW IF EXISTS attendance_history_view; 
    CREATE VIEW 
        attendance_history_view 
    AS SELECT 
        a.employee_id,
        b.employee_name, 
        b.employee_nip, 
        DATE(a.created_at) AS attendance_date,
        (SELECT 
            TIME(employee_attendance_table.created_at) 
        FROM 
            employee_attendance_table 
        INNER JOIN 
            employee_table 
        ON 
            employee_table.employee_id=employee_attendance_table.employee_id 
        WHERE 
            employee_attendance_table.attendance_type='PAGI' 
            AND 
            employee_attendance_table.employee_id=a.employee_id 
            AND 
            DATE(employee_attendance_table.created_at)=DATE(a.created_at)) AS PAGI, 
        (SELECT 
            TIME(employee_attendance_table.created_at) 
        FROM 
            employee_attendance_table 
        INNER JOIN 
            employee_table 
        ON 
            employee_table.employee_id=employee_attendance_table.employee_id 
        WHERE 
            employee_attendance_table.attendance_type='SORE' 
            AND 
            employee_attendance_table.employee_id=a.employee_id 
            AND 
            DATE(employee_attendance_table.created_at)=DATE(a.created_at)) AS SORE 
    FROM 
        employee_attendance_table AS a 
    INNER JOIN 
        employee_table AS b 
    ON 
        a.employee_id=b.employee_id";

echo ($conn->multi_query($sql) === TRUE) ? ("9<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}


$sql = "
    DROP VIEW IF EXISTS monthly_attendance_view;
    CREATE VIEW 
        monthly_attendance_view 
    AS SELECT 
        b.employee_id,
        b.employee_name, 
        b.employee_nip, 
        DATE(a.created_at) AS attendance_date,
        (SELECT TIME(employee_attendance_table.created_at) FROM employee_attendance_table INNER JOIN employee_table ON employee_table.employee_id=employee_attendance_table.employee_id WHERE employee_attendance_table.attendance_type='PAGI' AND employee_attendance_table.employee_id=a.employee_id AND DATE(employee_attendance_table.created_at)=DATE(a.created_at)) AS PAGI, 
        (SELECT TIME(employee_attendance_table.created_at) FROM employee_attendance_table INNER JOIN employee_table ON employee_table.employee_id=employee_attendance_table.employee_id WHERE employee_attendance_table.attendance_type='SORE' AND employee_attendance_table.employee_id=a.employee_id AND DATE(employee_attendance_table.created_at)=DATE(a.created_at)) AS SORE 
    FROM 
        employee_attendance_table AS a 
    INNER JOIN 
        employee_table AS b 
    ON 
        a.employee_id=b.employee_id ";

echo ($conn->multi_query($sql) === TRUE) ? ("10<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}

$sql = "
    DROP VIEW IF EXISTS attendance_today_view;
    CREATE VIEW 
        attendance_today_view 
    AS SELECT 
        a.employee_id,
        b.employee_name, 
        b.employee_nip, 
        DATE(a.created_at) AS created_at,
        a.attendance_type, 
        (SELECT 
            TIME(employee_attendance_table.created_at) 
        FROM 
            employee_attendance_table 
        INNER JOIN 
            employee_table 
        ON 
            employee_table.employee_id=employee_attendance_table.employee_id 
        WHERE 
            employee_attendance_table.attendance_type='PAGI' 
            AND 
            employee_attendance_table.employee_id=a.employee_id 
            AND 
            DATE(employee_attendance_table.created_at)=DATE(a.created_at)) AS PAGI
    FROM 
        employee_attendance_table AS a 
    INNER JOIN 
        employee_table AS b 
    ON 
        a.employee_id=b.employee_id";

echo ($conn->multi_query($sql) === TRUE) ? ("11<br>") : ("Error creating table: " . $conn->error);
while ($conn->next_result()) {;
}


$conn->close();
