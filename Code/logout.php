<?php

session_start();

if(!(isset($_SESSION['username']) && isset($_SESSION['password']))){
    echo "Error Unauthorize access";
    exit;
}

if(session_destroy()){
    echo 1;
}else{
    echo 0;
}


?>