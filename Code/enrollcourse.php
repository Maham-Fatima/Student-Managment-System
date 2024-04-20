<?php
require_once "connection.php";

session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "student")) {
    echo "Error: Unauthorized access";
    exit;
}

$sql = "SELECT * FROM course where courseId not in(SELECT cid from enrollment e join student s on s.ID = e.sid where username = '{$_SESSION['username']}'
and pass = '{$_SESSION['password']}')";
$result = mysqli_query($conn, $sql);

$data = "<div class='overflow-x-auto max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
<h2 class='text-2xl font-bold mb-4'>Offered Courses</h2>
<table class='min-w-full divide-y divide-gray-200'>
<thead class='bg-gray-50'>
<tr>
<th scope='col' class='md:px-6 md:py-3 px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Course ID</th>
<th scope='col' class='md:px-6 md:py-3 px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Course Name</th>    
<th scope='col' class='md:px-6 md:py-3 px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Action</th>            
</tr>
</thead>
<tbody class='bg-white divide-y divide-gray-200'>";

while ($row = mysqli_fetch_assoc($result)) {
    $data .= "<tr>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["courseId"]}</td>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["coursename"]}</td>    
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>
    <button type='submit' class='enroll-button-course' data-id='{$row["courseId"]}'>enroll</button>
    </td>    
</tr>";
}
$data .= "</tbody>
</table>
</div>";

echo $data;
?>
