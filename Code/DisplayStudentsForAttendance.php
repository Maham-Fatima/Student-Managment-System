<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "faculty")) {
    echo "Error: Unauthorized access";
    exit;
}

$aid = $_POST["attendance"];
$data = "
<div class='overflow-x-auto max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
<h2 class='text-2xl font-bold mb-4'>Mark student attendance</h2>

<table class='min-w-full divide-y divide-gray-200'>
    <thead class='bg-gray-50'>
        <tr>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Student Name</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Email</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Date</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Action</th>
        </tr>
    </thead>
    <tbody class='bg-white divide-y divide-gray-200'>
        
";
$sql = "SELECT * FROM studentattendance a JOIN student s on a.sid = s.ID JOIN attendance t on t.aid = a.aid where a.aid = $aid ";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $current = $row['attendance'];
    if($current == 'A'){
        $data .= "<tr>
    <td class='md:px-6 md:py-3 px-2  py-1 whitespace-nowrap'>{$row["username"]}</td>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["email"]}</td>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["date"]}</td>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>
    <select name='approval' class='attendance-dropdown' data-id='{$row['said']}'>
    <option value='P'>P</option>
    <option value='A' selected>A</option>   
    </select>
    <button type='submit' class='submit-button-mark-std' data-id='{$row['said']}' data-aid='{$aid}'>Mark</button>
    </td>
</tr>";
    }else{
        $data .= "<tr>
        <td class='md:px-6 md:py-3 px-2  py-1 whitespace-nowrap'>{$row["username"]}</td>
        <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["email"]}</td>
        <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["date"]}</td>
        <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>
        <select name='approval' class='attendance-dropdown' data-id='{$row['said']}'>
        <option value='P' selected>P</option>
        <option value='A'>A</option>   
        </select>
        <button type='submit' class='submit-button-mark-std' data-id='{$row['said']} data-aid='{$aid}'>Mark</button>
        </td>
    </tr>";
    }

    
}
$data .= "</tbody>
</table>
</form>
</div>
";
echo $data;
