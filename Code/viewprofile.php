<?php
require_once "connection.php";
session_start();
if(!(isset($_SESSION['username']) && isset($_SESSION['password']))){
    echo "Error Unauthorize access";
    exit;
}
$sql = "SELECT * from  {$_SESSION['user']} where username = '{$_SESSION['username']}' and pass = '{$_SESSION['password']}'";
$result = mysqli_query($conn, $sql);
if($row =mysqli_fetch_assoc($result)){
    // Assuming your image data is stored in a column named 'profile_image_data'
    $imageData = $row['profile_image_data'];
    $imageSrc = 'data:image/jpeg;base64,' . base64_encode($imageData); // Assuming the image is JPEG format
    
    $data = "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl'>
    <h2 class='m-5 text-3xl font-extrabold text-gray-900'>Profile</h2>
    <div class='md:flex md:items-center md:justify-between md:p-6 p-3'>
        <div class='md:flex-shrink-0'>
            <img class='h-48 w-full object-cover md:w-48' src='$imageSrc' alt='User Image'>
        </div>
        <div class='mt-4 md:mt-0 md:ml-6'>
            <div class='uppercase tracking-wide text-sm text-indigo-500 font-semibold'>Username</div>
            <p class='mt-2 text-xl font-extrabold text-gray-900'>{$row['username']}</p>
            <div class='mt-3 uppercase tracking-wide text-sm text-indigo-500 font-semibold'>Password</div>
            <p class='mt-2 text-sm text-gray-500'>{$row['pass']}</p>
            <div class='mt-3 uppercase tracking-wide text-sm text-indigo-500 font-semibold'>Email</div>
            <p class='mt-2 text-sm text-gray-500'>{$row['email']}</p>
        </div>
        
    </div>
    <div class='md:p-6 p-3'>
        <button type='submit' id='edit-button-profile' class='bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600' >Edit Profile</button>
    </div>
</div>";
}

echo $data;
?>
