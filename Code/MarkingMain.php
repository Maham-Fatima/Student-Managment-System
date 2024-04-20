<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "faculty")){
    echo "Error: Unauthorized access";
    exit;
}

$ID = $_POST["ID"];
$marks = $_POST["Marks"];

// Fetch mid for the given smid
$sql_mid = "SELECT mid FROM studentmarks WHERE smid = $ID";
$result_mid = mysqli_query($conn, $sql_mid);

if (!$result_mid) {
    echo "Error fetching mid: " . mysqli_error($conn);
    exit;
}

$row_mid = mysqli_fetch_assoc($result_mid);
$mid = $row_mid['mid'];

// Fetch total_marks for the given mid from the marks table
$sql_total_marks = "SELECT total_marks FROM marks WHERE mid = $mid";
$result_total_marks = mysqli_query($conn, $sql_total_marks);

if (!$result_total_marks) {
    echo "Error fetching total marks: " . mysqli_error($conn);
    exit;
}

$row_total_marks = mysqli_fetch_assoc($result_total_marks);
$total_marks = $row_total_marks['total_marks'];

// Validate marks against total marks
if ($marks < 0 || $marks > $total_marks) {
    echo "Error: Marks should be between 0 and $total_marks";
    exit;
}

// Update obtained marks
$sql_update = "UPDATE studentmarks SET obtained_marks = $marks WHERE smid = $ID";
$result_update = mysqli_query($conn, $sql_update);

if ($result_update) {
   echo "1"; 
} else {
    echo "< div class = 'max-w-md mx-auto bg-white rounded-lg shadow-lg p-6' ><h2 class = 'text-md text-red-500 font-bold mb-4'><h2>Error: Updating mark make sure range of marks is correct </h2></div >";
}
?>
