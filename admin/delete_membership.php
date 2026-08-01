<?php
global $conn;
include '../db_connect.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    mysqli_query($conn,
    "DELETE FROM membership_plans WHERE id='$id'");

    header("Location: membership.php");
    exit();
}
?>