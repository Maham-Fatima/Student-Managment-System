
<?php

require_once "connection.php";

session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']))){
    echo "Error: Unauthorized access";
    exit;
}
if($_SESSION['user'] == "student"){
    $sql = "SELECT cid FROM enrollment c JOIN student f on f.ID = c.sid where f.username ='{$_SESSION['username']}' and f.pass = '{$_SESSION['password']}'";
}else if($_SESSION['user'] == "faculty"){
    $sql = "SELECT cid FROM courseassignment c JOIN faculty f on f.ID = c.fid where f.username ='{$_SESSION['username']}' and f.pass = '{$_SESSION['password']}'";
}else{
    $sql = "SELECT courseId as cid FROM course";
}


$result = mysqli_query($conn, $sql);
$type = $_POST["type"];
$data = "<div class='overflow-x-auto max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6 w-full'>
<h2 class='text-2xl font-bold mb-4'>Courses Assigned</h2>";

while ($row = mysqli_fetch_assoc($result)) {
    if($type == "display"){

         $data .= "<button class='display-enrolled-student-button' data-id='{$row['cid']}'>{$row['cid']}</button>";

    }else if($type == "addattendance"){

        $data .= "<button class='add-attendance-button' data-id='{$row['cid']}'>{$row['cid']}</button>";
    }
    else if($type == "markstudentattendance"){

        $data .= "<button class='add-student-attendance-button' data-id='{$row['cid']}'>{$row['cid']}</button>";// after this button move to attendance display table

    }else if($type == "viewonly"){

        $data .= "<label class='bg-blue-500 text-white font-bold px-3 py-2 rounded-xl'>{$row['cid']}</label>";

    }else if($type == "addmarks"){

        $data .= "<button class='add-marks-button' data-id='{$row['cid']}'>{$row['cid']}</button>";

    }
    else if($type == "marksstudentmarks"){

        $data .= "<button class='add-student-marks-button' data-id='{$row['cid']}'>{$row['cid']}</button>";

    }else if($type ==  "viewmarks" && $_SESSION['user'] == "student"){

        $data .= "<button class='view-marks-button-student' data-id='{$row['cid']}'>{$row['cid']}</button>";

    }else if($type ==  "viewmarks"){

        $data .= "<button class='view-marks-button' data-id='{$row['cid']}'>{$row['cid']}</button>";

    }else if($type ==  "viewattendance"  && $_SESSION['user'] == "student"){

        $data .= "<button class='view-attendance-button-student' data-id='{$row['cid']}'>{$row['cid']}</button>";

    }else if($type == "viewattendance"){

        $data .= "<button class='view-attendance-button' data-id='{$row['cid']}'>{$row['cid']}</button>";

    }
   
}
$data .= "</div>";

echo $data;
?>
