<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "administrator")) {
    echo "Error: Unauthorized access";
    exit;
}

$id = $_POST['cid'];
$sql = "DELETE FROM course WHERE courseId='$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0) {
    $data = "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6'>
    <h2 class='text-xl font-bold mb-4'>course deleted successfully</h2>
    </div>";
    exit;
} else {
    $data = "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6'>
            <h2 class='text-xl font-bold mb-4'>course deletion fail</h2>
            </div>";
}
echo $data;
