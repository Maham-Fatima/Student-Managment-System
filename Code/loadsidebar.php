<?php

require_once "connection.php";
session_start();

if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
  echo "Error: Unauthorized access";
  exit;
}


$user = $_SESSION["user"];


switch ($user) {
  case 'administrator':
    adminPanel($conn);
    break;

  case 'student':
    studentPanel($conn);
    break;

  case 'faculty':
    facultyPanel($conn);
    break;
  default:
    break;
}

function adminPanel($conn)
{
  $sql = "SELECT * FROM AdminCategory";
  $result = mysqli_query($conn, $sql);
  $data = "<hr class='bg-slate-500 my-2' /> <ul class='p-3 md:mx-4 flex flex-col'>";
  while ($row = mysqli_fetch_assoc($result)) {
    $category = str_replace(' ', '', $row['category']);
  
    $data .= "<li class='flex mb-3 hover:bg-slate-500 hover:rounded-lg'>
            <i class='bi bi-caret-right hidden md:block'></i
            ><button id='{$category}'>{$category}</button>
          </li>";
  }
  $data .= "</ul>";
  echo $data;
}
function studentPanel($conn)
{
  $sql = "SELECT * FROM StudentCategory";
  $result = mysqli_query($conn, $sql);
  $data = "<hr class='bg-slate-500 my-2' /> <ul class='p-3 md:mx-4 flex flex-col'>";
  while ($row = mysqli_fetch_assoc($result)) {
    $category = str_replace(' ', '', $row['category']);
   
    $data .= "<li class='flex mb-3 hover:bg-slate-500 hover:rounded-lg'>
            <i class='bi bi-caret-right hidden md:block'></i
            ><button id='{$category}'>{$category}</button>
          </li>";
  }
  $data .= "</ul>";
  echo $data;
}
function facultyPanel($conn)
{
  $sql = "SELECT * FROM FacultyCategory";
  $result = mysqli_query($conn, $sql);
  $data = "<hr class='bg-slate-500 my-2' /> <ul class='p-3 md:mx-4 flex flex-col'>";
  while ($row = mysqli_fetch_assoc($result)) {
    $category = str_replace(' ', '', $row['category']);
   
    $data .= "<li class='flex mb-3 hover:bg-slate-500 hover:rounded-lg'>
            <i class='bi bi-caret-right hidden md:block'></i
            ><button id='{$category}'>{$category}</button>
          </li>";
  }
  $data .= "</ul>";
  echo $data;
}
?>
