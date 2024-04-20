<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['user'] == "faculty") ) {
    echo "Error: Unauthorized access";
    exit;
}
$cid = $_POST["cid"];
$data = "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
<h2 class='text-2xl font-bold mb-4'>Add Course Mark</h2>
<form>
    <div class='mb-4'>
        <label for='courseId' class='block text-gray-700 font-bold mb-2'>Course ID</label>
        <input type='text' id='courseId' name='courseId' class='w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500' value='{$cid}' readonly>
    </div>
    <div class='mb-4'>
        <label for='type' class='block text-gray-700 font-bold mb-2'>Enter marks category:</label>
        <input type='text' id='type'  class='w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500'>
    </div>
    <div class='mb-4'>
        <label for='total_marks' class='block text-gray-700 font-bold mb-2'>Enter total marks:</label>
        <input type='number' id='totalMarks' step='0.1' class='w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500'>
    </div>
    <input type='submit' class='bg-blue-600 hover:bg-blue-200 text-white px-4 py-2 rounded-lg hover:bg-blue-600' value='Add course marks' id='coursemarks'>
</div></form>";


echo $data;
?>
