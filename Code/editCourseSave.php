<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "administrator")) {
    echo "Error: Unauthorized access";
    exit;
}

$id = $_POST['courseId'];
$name = $_POST['coursename'];

$sql = "UPDATE course set coursename='$name' where courseId = '$id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $data = "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6'>
    <h2 class='text-xl font-bold mb-4'>course updated successfully</h2>
    </div>";
    
} else {
    $data = "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6'>
    <h2 class='text-xl font-bold mb-4'>course update fail</h2>
    </div>";
}
echo $data;

?>