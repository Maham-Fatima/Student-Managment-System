<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "administrator")) {
    echo "Error: Unauthorized access";
    exit;
}

$data = "
<div class='overflow-x-auto max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6'>
<h2 class='text-2xl font-bold mb-4'>Enable/Disable student</h2>
<form method='post' action='process_approval.php'> <!-- Assuming process_approval.php is the script for processing form submission -->
<table class='min-w-full divide-y divide-gray-200'>
    <thead class='bg-gray-50'>
        <tr>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Name</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Password</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Email</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Action</th>
        </tr>
    </thead>
    <tbody class='bg-white divide-y divide-gray-200'>
        
";
$sql = "SELECT * FROM student";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $current = $row['enable_status'];
    if($current){
        $data .= "<tr>
    <td class='md:px-6 md:py-3 px-2  py-1 whitespace-nowrap'>{$row["username"]}</td>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["pass"]}</td>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["email"]}</td>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>
    <select name='approval' class='enable-dropdown' data-id='{$row['ID']}'>
    <option value='disable'>disable</option>
    <option value='enable' selected>enable</option>   
    </select>
    <button type='submit' class='submit-button-enable' data-id='{$row['ID']}'>Submit</button>
    </td>
</tr>";
    }else{
        $data .= "<tr>
    <td class='md:px-6 md:py-3 px-2  py-1 whitespace-nowrap'>{$row["username"]}</td>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["pass"]}</td>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["email"]}</td>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>
    <select name='approval' class='enable-dropdown' data-id='{$row['ID']}'>
    <option value='disable' selected>disable</option>
    <option value='enable'>enable</option>   
    </select>
    <button type='submit' class='submit-button-enable' data-id='{$row['ID']}'>Submit</button>
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
