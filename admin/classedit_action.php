<?php
global $conn;
include '../db_connect.php';

if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $instructor = $_POST['instructor'];
    $level = $_POST['level'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    // UPDATE QUERY
    $sql = "UPDATE classes SET 
            name='$name',
            instructor='$instructor',
            level='$level',
            duration='$duration',
            price='$price',
            status='$status'
            WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: classes.php");
        exit();
    } else {
        echo "Update failed: " . $conn->error;
    }

} else {
    echo "Invalid Request!";
}
?>