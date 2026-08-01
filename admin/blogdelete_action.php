<?php
include('../db_connect.php');
global $conn;

$id = $_GET['id'];

$sql = "DELETE FROM blogs WHERE id='$id'";

if(mysqli_query($conn, $sql)){
    header("Location: blogs.php");
}
else{
    echo "Delete failed";
}
?>