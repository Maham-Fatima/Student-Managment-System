<?php
session_start();
if(!(isset($_SESSION['username']) && isset($_SESSION['password']))){
    echo "Error Unauthorize access";
    exit;
}
$data = "
<div class='overflow-x-auto flex flex-col m-5'>
<div>
    <h2 class=' text-3xl font-extrabold text-gray-900'>Change Password</h2>
</div>
    <label for='new_password' class='mt-3'>New Password:</label><br>
    <input type='password' id='password' name='new_password'><br>
    <input type='submit' id='save' class='mt-3 bg-blue-900 hover:bg-blue-500 p-2 text-white rounded-xl'>
</div>";

echo $data;
?>
