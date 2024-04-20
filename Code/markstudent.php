<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "faculty")){
    echo "Error: Unauthorized access";
    exit;
}

$ID = $_POST["ID"];
$act = $_POST["Action"];

if($act == "A"){
    $sql = "UPDATE studentattendance SET attendance = 'A' WHERE said = $ID";
} else {
    $sql = "UPDATE studentattendance SET attendance = 'P' WHERE said = $ID";
}

$result = mysqli_query($conn,$sql);

if($result){
   echo "1"; 
}
else{
    echo "0";
}

?>