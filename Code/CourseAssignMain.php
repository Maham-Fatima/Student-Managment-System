<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "administrator")) {
    echo "Error: Unauthorized access";
    exit;
}

$cid = $_POST["courseId"];
$fid = $_POST["facultyId"];

$sql = "INSERT into CourseAssignment (cid,fid) values ('{$cid}',$fid)";

$result = mysqli_query($conn,$sql);

if($result){
    $data = "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6'>
<h2 class='text-xl font-bold mb-4'>Course assigned successfully</h2>
</div>";
}else{
    $data = "<div class='max-w-md mx-auto bg-white rounded-lg shadow-lg p-6'>
    <h2 class='text-xl font-bold mb-4'>Error: fail to assign</h2>
    </div>";
}

echo $data;
?>