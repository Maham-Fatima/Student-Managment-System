<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    echo "Error: Unauthorized access";
    exit;
}

$newpassword = $_POST["pass"];
$userTable = $_SESSION['user'];

$sql = "UPDATE {$userTable} SET pass = '{$newpassword}' WHERE username = '{$_SESSION['username']}' AND pass = '{$_SESSION['password']}'";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "1";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
