=<?php
require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    echo "Error: Unauthorized access";
    exit;
}

$name = trim($_POST['name']);
$password = $_POST['password'];
$email = trim($_POST['email']);
$fileData = "";
$fileName = "";

if (isset($_FILES["profileImage"]) && $_FILES["profileImage"]["error"] === UPLOAD_ERR_OK) {
    $fileName = $_FILES["profileImage"]["name"];
    $fileTmpName = $_FILES["profileImage"]["tmp_name"];
    $fileData = file_get_contents($fileTmpName);
}

$sql = "";
if (!empty($fileData) && !empty($fileName)) {
    
    $sql = "UPDATE {$_SESSION['user']} SET username=?, pass=?, email=?, profile_image_data=?, profile_image_name=? WHERE username=? AND pass=?";
} else {
    
    $sql = "UPDATE {$_SESSION['user']} SET username=?, pass=?, email=? WHERE username=? AND pass=?";
}

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    if (!empty($fileData) && !empty($fileName)) {
       
        mysqli_stmt_bind_param($stmt, "ssbssss", $name, $password, $email, $fileData, $fileName, $_SESSION['username'], $_SESSION['password']);
    } else {
        
        mysqli_stmt_bind_param($stmt, "sssss", $name, $password, $email, $_SESSION['username'], $_SESSION['password']);
    }

    if (mysqli_stmt_execute($stmt)) {
        $data = "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
        <h2 class='text-xl font-bold mb-4'>Profile updated successfully</h2>
        </div>";
        $_SESSION['username'] = $name;
        $_SESSION['password'] = $password;
       
    } else {
        $data = "<div class='overflow-x-auto max-w-md mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
        <h2 class='text-xl font-bold mb-4'>Profile update failed</h2>
        </div>";
        
    }

    
    mysqli_stmt_close($stmt);
    echo $data;
} else {
    
    echo "Error: Unable to prepare statement";
    exit;
}
?>
