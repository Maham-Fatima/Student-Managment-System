<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "faculty")) {
    echo "Error: Unauthorized access";
    exit;
}

$id = $_POST["cid"];
$d = $_POST["date"];

$sql = "INSERT INTO Attendance (cid, date) VALUES ('{$id}', '{$d}')";

$result = mysqli_query($conn, $sql);

if ($result) {
    // Get the attendance ID (aid) of the newly inserted attendance record
    $aid = mysqli_insert_id($conn);

   
    $enrolled_students_sql = "SELECT sid FROM Enrollment WHERE cid = '{$id}'";
    $enrolled_students_result = mysqli_query($conn, $enrolled_students_sql);

    if ($enrolled_students_result) {
        while ($row = mysqli_fetch_assoc($enrolled_students_result)) {
            $sid = $row['sid'];

           
            $insert_student_attendance_sql = "INSERT INTO Studentattendance (aid, sid) VALUES ('{$aid}', '{$sid}')";
            $insert_result = mysqli_query($conn, $insert_student_attendance_sql);

            if (!$insert_result) {
                echo "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6'>
                    <h2 class='text-xl font-bold mb-4'>Failed to add attendance for student with ID: {$sid}</h2>
                    </div>";
            }
        }
        echo "<div class='max-w-md mx-auto bg-white rounded-lg shadow-lg p-6'>
            <h2 class='text-xl font-bold mb-4'>Attendance and student records added successfully</h2>
            </div>";
    } else {
        echo "<div class='max-w-md mx-auto bg-white rounded-lg shadow-lg p-6'>
            <h2 class='text-xl font-bold mb-4'>Failed to retrieve enrolled students</h2>
            </div>";
    }
} else {
    echo "<div class='max-w-md mx-auto bg-white rounded-lg shadow-lg p-6'>
        <h2 class='text-xl font-bold mb-4'>Failed to add attendance</h2>
        </div>";
}

?>
