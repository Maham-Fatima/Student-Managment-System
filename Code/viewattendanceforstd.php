<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "student")) {
    echo "Error: Unauthorized access";
    exit;
}

$cid = $_POST["cid"];
$data = "
<div class='overflow-x-auto max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
<h2 class='text-2xl font-bold mb-4'>attendance for {$cid}</h2>

<table class='min-w-full divide-y divide-gray-200'>
    <thead class='bg-gray-50'>
        <tr>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Date</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Status</th>
        </tr>
    </thead>
    <tbody class='bg-white divide-y divide-gray-200'>
        
";
$sql = "SELECT * FROM studentattendance a JOIN student s on a.sid = s.ID JOIN attendance t on t.aid = a.aid where s.username = '{$_SESSION["username"]}' AND s.pass = '{$_SESSION["password"]}' AND t.cid = '$cid'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $current = $row['attendance'];
    $data .= "<tr>
   
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["date"]}</td>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>
    $current
    </td>
</tr>";
}
$data .= "</tbody>
</table>
</form>
</div>
";
echo $data;
