<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "faculty")) {
    echo "Error: Unauthorized access";
    exit;
}

$mid = $_POST["mid"];
$data = "
<div class='overflow-x-auto max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
<h2 class='text-2xl font-bold mb-4'>Upload Marks</h2>

<table class='min-w-full divide-y divide-gray-200'>
    <thead class='bg-gray-50'>
        <tr>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Student Name</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Email</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Total Marks</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Obtained Marks</th>
            <th scope='col' class='md:px-6 md:py-3 px-2  py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>Action</th>
        </tr>
    </thead>
    <tbody class='bg-white divide-y divide-gray-200'>
        
";
$sql = "SELECT * FROM studentmarks a JOIN student s on a.sid = s.ID JOIN marks t on t.mid = a.mid where a.mid = $mid ";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $current = $row['obtained_marks'];
    $marks = $row['total_marks'];
    if($current == null){
        $data .= "<tr>
    <td class='md:px-6 md:py-3 px-2  py-1 whitespace-nowrap'>{$row["username"]}</td>
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["email"]}</td> 
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["total_marks"]}</td>  
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>-</td>  
    <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>
    <input type='number' step='any' class='marks-field' min=0 max=$marks>
    <button type='submit' class='submit-button-marking-std' data-id='{$row['smid']}' data-mid='{$mid}'>Mark</button>
    </td>
</tr>";
    }else{
        $data .= "<tr>
        <td class='md:px-6 md:py-3 px-2  py-1 whitespace-nowrap'>{$row["username"]}</td>
        <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["email"]}</td> 
        <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["total_marks"]}</td>  
        <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>{$row["obtained_marks"]}</td>  
        <td class='md:px-6 md:py-3 px-2 py-1 whitespace-nowrap'>
        <input type='number' step='0.1' class='marks-field' min=0 max=$marks>
        <button type='submit' class='submit-button-marking-std' data-id='{$row['smid']}' data-mid='{$mid}'>Mark</button>
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
