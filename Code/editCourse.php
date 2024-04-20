<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "administrator")) {
    echo "Error: Unauthorized access";
    exit;
}

$id = $_POST['id'];
$sql = "SELECT * from course where courseId='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['courseId'];
    $name = $row['coursename'];
    
    
    $formHTML = "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
    <h2 class='text-2xl font-bold mb-4'>Edit Course</h2>
    <form>
        <div class='mb-4'>
            <label for='id' class='block text-gray-700 font-bold mb-2'>Course ID</label>
            <input type='text' id='id' name='id' class='w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500' value='$id' readonly>
        </div>
        <div class='mb-4'>
            <label for='name' class='block text-gray-700 font-bold mb-2'>Course Name</label>
            <input type='text' id='name' name='name' class='w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500' value='$name'>
        </div>
        <button type='submit' class='bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600' id='save-button-course'>Update</button>
    </form>
</div>";


    
    echo $formHTML;
}
?>
