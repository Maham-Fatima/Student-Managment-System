<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    echo "Error: Unauthorized access";
    exit;
}
$id = $_POST["id"];

$sql = "SELECT ID from student where username = '{$_SESSION['username']}' and pass = '{$_SESSION['password']}'";
$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);

$sql = "INSERT into enrollment (cid,sid) values ('{$id}',$row[ID])";

$result = mysqli_query($conn,$sql);

if($result){
    $data = "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
<h2 class='text-xl font-bold mb-4'>enrolled successfully</h2>
</div>";
}else{
    $data = "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
    <h2 class='text-xl font-bold mb-4'>Fail to enroll</h2>
    </div>";
}

echo $data;
?>