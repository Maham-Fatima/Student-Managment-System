<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "administrator")) {
    echo "Error: Unauthorized access";
    exit;
}
$sql = "SELECT * FROM course";
$result = mysqli_query($conn, $sql);

$data = "<div class='overflow-x-auto flex flex-col max-w-md mx-auto bg-white rounded-lg shadow-lg p-6 w-full'><h2 class='text-xl font-bold mb-4'>Course Assignment</h2>";

$data .= "<label for='course-list' class='mt-5'>Select Course:</label>";
$data .= "<select id='course-list' name='courseId' class='border border-blue-500 rounded px-4 py-2'>";
while ($row = mysqli_fetch_assoc($result)) {
    $data .= "<option value='{$row["courseId"]}'>{$row["coursename"]}</option>";
}
$data.="</select>";
$sql = "SELECT * FROM faculty";
$result = mysqli_query($conn, $sql);


$data .= "<label for='faculty-list' class='mt-5'>Select Faculty:</label>";
$data .= "<select id='faculty-list' name='facultyId' class='border border-blue-500 rounded px-4 py-2'>";
while ($row = mysqli_fetch_assoc($result)) {
    $data .= "<option value='{$row["ID"]}'>{$row["username"]}  {$row["email"]}</option>";
}
$data.="</select>";

$data.="<button type='submit' id='assignCourseButton' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-5'>Assign Course</button>";
$data.="</div>";

echo $data;
?>
