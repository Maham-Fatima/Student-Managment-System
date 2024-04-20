<?php
require_once "connection.php";
session_start();

if(!(isset($_SESSION['username']) && isset($_SESSION['password']))){
    echo "Error Unauthorize access";
    exit;
}

$user = $_SESSION["user"];
$username = $_SESSION['username'];
$password = $_SESSION['password'];

$sql = "SELECT * FROM $user WHERE username='$username' AND pass='$password'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: unable to fetch data";
    exit;
}

$row = mysqli_fetch_assoc($result);
$name = $row['username'];
$pass = $row['pass'];
$email = $row['email'];

$formHTML =  "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
<h2 class='text-2xl font-bold mb-4'>Edit Profile</h2>
<form id='updateForm' enctype='multipart/form-data' method='POST'>
    <div class='mb-4'>
        <label for='name' class='block text-gray-700 font-bold mb-2'>Name</label>
        <input type='text' id='name' name='name' class='w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500' value='$name'>
    </div>
    <div class='mb-4'>
        <label for='pass' class='block text-gray-700 font-bold mb-2'>Password</label>
        <input type='text' id='pass' name='pass' class='w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500' value='$pass'>
    </div>
    <div class='mb-4'>
        <label for='email' class='block text-gray-700 font-bold mb-2'>Email</label>
        <input type='text' id='email' name='email' class='w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500' value='$email'>
    </div>
    <div class='mb-4'>
        <label for='profileImage' class='block text-gray-700 font-bold mb-2'>Profile Image</label>
        <input type='file' id='profileImage' name='profileImage'>
    </div>
    <button type='submit' class='bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600' id='save-button-profile'>Update</button>
</form>
</div>";

echo $formHTML;
?>
