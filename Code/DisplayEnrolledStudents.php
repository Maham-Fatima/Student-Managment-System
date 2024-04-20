<?php
require_once "connection.php";

session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "faculty")) {
    echo "Error: Unauthorized access";
    exit;
}

$cid = $_POST["cid"];
$sql = "SELECT c.courseId as ccid , c.coursename as cn, s.username as nam, s.email as e FROM enrollment a JOIN faculty f ON a.fid = f.ID JOIN course c ON a.cid = c.courseId JOIN 
student s ON s.ID = a.sid where f.username ='{$_SESSION['username']}' and f.pass = '{$_SESSION['password']}' and c.courseId = '{$cid}'";

$result = mysqli_query($conn, $sql);

$data = "<div class='overflow-x-auto max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
<h2 class='text-2xl font-bold mb-4'>Courses Detail</h2>
<table class='min-w-full divide-y divide-gray-200'>
<thead class='bg-gray-50'>
<tr>
<th scope='col' class='md:px-6 md:py-3 px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Course ID</th>
<th scope='col' class='md:px-6 md:py-3 px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Course Name</th>     
<th scope='col' class='md:px-6 md:py-3 px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Student Name</th>        
<th scope='col' class='md:px-6 md:py-3 px-2 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Student Email</th>   
</tr>
</thead>
<tbody class='bg-white divide-y divide-gray-200'>";

while ($row = mysqli_fetch_assoc($result)) {
    $data .= "<tr>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["ccid"]}</td>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["cn"]}</td>    
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["nam"]}</td>   
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["e"]}</td>   
</tr>";
}
$data .= "</tbody>
</table>
</div>";

echo $data;
?>
