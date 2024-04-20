<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "administrator")){
    echo "Error: Unauthorized access";
    exit;
}

$ID = $_POST["ID"];
$act = $_POST["Action"];

if($act == "disable"){
    $sql = "UPDATE student SET enable_status = 0 WHERE ID = $ID";
} else {
    $sql = "UPDATE student SET enable_status = 1 WHERE ID = $ID";
}

$result = mysqli_query($conn,$sql);

if($result){
   echo "1"; 
}
else{
    echo "0";
}

?>