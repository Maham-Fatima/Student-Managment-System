<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "administrator")) {
    echo "Error: Unauthorized access";
    exit;
}

$ID = $_POST["ID"];
$act = $_POST["Action"];
$sql = "UPDATE student set approved = 1 where ID = $ID";

if($act == "reject"){
    $sql = "DELETE from student where ID = $ID";
}

$result = mysqli_query($conn,$sql);

if($result){
   echo "1"; 
   exit;
}
else{
    echo "0";
    exit;
}

?>