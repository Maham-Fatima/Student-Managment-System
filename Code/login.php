<?php 
require_once "connection.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    $sql1 = "SELECT * FROM student WHERE username = '{$_POST['name']}' AND pass = '{$_POST['password']}'";
    $sql2 = "SELECT * FROM faculty WHERE username = '{$_POST['name']}' AND pass = '{$_POST['password']}'";
    $sql3 = "SELECT * FROM administrator WHERE username = '{$_POST['name']}' AND pass = '{$_POST['password']}'";
    
    $result = mysqli_query($conn, $sql1);
    $user = "student";
    fetch($result, $user);
    
    $result = mysqli_query($conn, $sql2);
    $user = "faculty";
    fetch($result, $user);
    
    $result = mysqli_query($conn, $sql3);
    $user = "administrator";
    fetch($result, $user);
    
    echo "fail";
}

function fetch($result, $user){
    $row = mysqli_fetch_assoc($result);
    if($row){

        session_start();
        $_SESSION['username'] = $_POST['name'];
        $_SESSION['password'] = $_POST['password'];    
        $_SESSION['user'] = $user;
        
        if($user == "student" && ($row["approved"] == 0 || $row["enable_status"] == 0)){
            echo "pending";
            exit;
        } else {
            echo "success";
            exit;
        }             
    }
}
?>
