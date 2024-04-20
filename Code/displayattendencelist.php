<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "faculty")) {
    echo "Error: Unauthorized access";
    exit;
}
$cid = $_POST["cid"];

$data = "
<div class='overflow-x-auto max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6'>
<h2 class='text-2xl font-bold mb-4'>Attendance Sheet</h2>

<table class='min-w-full divide-y divide-gray-200'>
    <thead class='bg-gray-50'>
        <tr>
            
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Date</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Action</th>
        </tr>
    </thead>
    <tbody class='bg-white divide-y divide-gray-200'>
        
";
$sql = "SELECT * FROM Attendance a where cid = '$cid' ";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
   
    
        $data .= "<tr>
    <td class='md:px-6 md:py-3 px-2  py-1 whitespace-nowrap'>{$row["date"]}</td>
    <td><button type='submit' class='student-attendance-view-button' data-id='{$row['aid']}'>Mark Attendance</button></td></tr>";
    

    
}
$data .= "</tbody>
</table>
</form>
</div>
";
echo $data;
