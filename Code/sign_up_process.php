<?php
require_once "connection.php";

$response = ''; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    $designation = $_POST['designation'];
    $valid = true;

    if (empty($name) || empty($password) || empty($email)) {
        $response = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = 'Invalid email format.';
    } elseif (strlen($name) < 3 || strlen($name) > 50 || !preg_match("/^[a-zA-Z ]+$/", $name)) {
        $response = 'Name must be between 3 and 50 characters and can only contain letters and spaces.';
    } else {
        if ($_FILES["profileImage"]["error"] === UPLOAD_ERR_OK) {
            $fileName = $_FILES["profileImage"]["name"];
            $fileTmpName = $_FILES["profileImage"]["tmp_name"];
            $fileSize = $_FILES["profileImage"]["size"];
            $fileType = $_FILES["profileImage"]["type"];

            // Read file data
            $fileData = file_get_contents($fileTmpName);

            // Prepare and execute SQL to insert user data with image into database
            if ($designation == "student") {
                $sql = "INSERT INTO student (username, pass, email, profile_image_name, profile_image_data) VALUES (?, ?, ?, ?, ?)";
            } elseif ($designation == "faculty") {
                $sql = "INSERT INTO faculty (username, pass, email, profile_image_name, profile_image_data) VALUES (?, ?, ?, ?, ?)";
            } else {
                $sql = "INSERT INTO administrator (username, pass, email, profile_image_name, profile_image_data) VALUES (?, ?, ?, ?, ?)";
            }

            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssss", $name, $password, $email, $fileName, $fileData);
                if (mysqli_stmt_execute($stmt)) {
                    $response = 'success';
                } else {
                    $response = 'Failed to execute query.';
                }
                mysqli_stmt_close($stmt);
            } else {
                $response = 'Failed to prepare statement.';
            }
        } else {
            $response = 'Failed to upload image.';
        }
    }
} else {
    $response = 'Invalid request.';
}

// Send response
echo $response;
?>
