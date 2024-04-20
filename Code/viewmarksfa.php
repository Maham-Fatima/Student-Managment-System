<?php
require_once "connection.php";
session_start();

// Check if the user is authorized
if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && (($_SESSION['user'] == "faculty") || $_SESSION['user'] == "administrator"))) {
    echo "Error: Unauthorized access";
    exit;
}

// Fetch types from the marks table for the given course ID (cid)
$cid = $_POST['cid']; // Assuming you'll receive the course ID from somewhere, such as a form
$sql = "SELECT DISTINCT type FROM marks WHERE cid = '$cid'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Initialize the table data
$tableData = "
<div class='overflow-x-auto max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
    <h2 class='text-2xl font-bold mb-4'>Student Marks</h2>
";

// Loop through each assessment type and generate a table for it
while ($row = mysqli_fetch_assoc($result)) {
    $type = $row['type'];
    $tableData.="<table class='min-w-full divide-y divide-gray-200'>
    <h3 class='text-lg font-semibold mb-2 w-full md:bg-blue-900 md:text-white md:text-center'>$type</h3>
    <thead class='bg-gray-50'>
        <tr>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Student Name</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Email</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Total Marks</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Obtained Marks</th>
           
        </tr>
    </thead>
    <tbody class='bg-white divide-y divide-gray-200'>
        
";


    // Fetch student marks for the current assessment type
    $sql = "SELECT * FROM studentmarks a JOIN student s ON a.sid = s.ID JOIN marks t ON t.mid = a.mid AND t.type = '$type' AND t.cid = '$cid'";
    $result_student_marks = mysqli_query($conn, $sql);

    if (!$result_student_marks) {
        die("Error: " . mysqli_error($conn));
    }

    // Process fetched data and populate the table
    while ($student_row = mysqli_fetch_assoc($result_student_marks)) {
        $current = $student_row['obtained_marks'];
        $marks = $student_row['total_marks'];
        $obtainedMarksCell = $current == null ? '-' : $current;
        $tableData .= "<tr>
        <td class='md:px-6 md:py-3 px-2  py-1 whitespace-nowrap'>{$student_row["username"]}</td>
        <td class='md:px-6 md:py-3 px-2  py-1 whitespace-nowrap'>{$student_row["email"]}</td>
        <td class='md:px-6 md:py-3 px-2  py-1 whitespace-nowrap'>{$student_row["total_marks"]}</td>
        <td class='md:px-6 md:py-3 px-2  py-1 whitespace-nowrap'>{$obtainedMarksCell}</td>
        </tr>";
    }

    $tableData .= "</tbody></table><br>"; // Close the table for the current assessment type
}

// Close the main container and display the tables
$tableData .= "</div>";
echo $tableData;
?>
