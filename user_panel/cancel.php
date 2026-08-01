<?php
global $conn;
include '../db_connect.php';
session_start();

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$conn->query("UPDATE booking SET status='Cancelled' 
WHERE id=$id AND user_id=$user_id");

header("Location: myclasses_user.php");
?>