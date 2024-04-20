<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "administrator") ) {
    echo "Error: Unauthorized access";
    exit;
}

$data = "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
<h2 class='text-2xl font-bold mb-4'>Add Course</h2>
<form>
    <div class='mb-4'>
        <label for='courseId' class='block text-gray-700 font-bold mb-2'>Course ID</label>
        <input type='text' id='courseId' name='courseId' class='w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500' placeholder='Enter Course ID'>
    </div>
    <div class='mb-4'>
        <label for='courseName' class='block text-gray-700 font-bold mb-2'>Course Name</label>
        <input type='text' id='courseName' name='courseName' class='w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500' placeholder='Enter Course Name'>
    </div>
    <input type='submit' class='bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600' value='Add course' id='submitcourse'>
</div></form>";


echo $data;
?>