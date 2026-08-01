<!-- <?php
    // global $conn;
    // $conn=mysqli_connect("localhost","root","","mysql");
    // if(!$conn){
    //     die("Db not connected").mysqli_connect_error();
    // }
?>   -->

<?php
global $conn;
$conn = mysqli_connect("localhost", "root", "", "clg_project");

if (!$conn) {
    die("DB not connected: " . mysqli_connect_error());
}
?>














