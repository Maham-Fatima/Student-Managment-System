<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "StudentManagementSystem";
try {
    $conn = mysqli_connect($server, $username, $password, $database);
} catch (mysqli_sql_exception) {
    echo "some error occured";
}
