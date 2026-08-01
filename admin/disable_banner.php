<?php
global $conn;
include('../db_connect.php');

$id = $_GET['id'];

$sql = "UPDATE banners SET status=0 WHERE id='$id'";

mysqli_query($conn,$sql);

header("Location: overview.php");

?>