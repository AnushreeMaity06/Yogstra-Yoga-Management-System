<?php
include('db_connect.php');
global $conn;

session_start();

// If not logged in
if(!isset($_SESSION['user_name'])){
    header("Location:login.php");
    exit();
}
?>

<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="" enctype="multipart/form-data" >
    <h1>Welcome <?php echo $_SESSION['user_name'];?></h1>
    <div>
        <?php 
            $img="SELECT * FROM `users`";
            $res = mysqli_query($conn, $img); 
            while($row = mysqli_fetch_assoc($res)){?>
            <img src="images/<?php echo $row['image'] ?>" alt="pic">
        <?php } ?>
    </div>
    <a href="logout.php">Logout</a>

</form>

</body>
</html> 




