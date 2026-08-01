<?php
    include('db_connect.php');
    global $conn;
    session_start();

    $user_id=$_SESSION['user_id'];
    $sql="SELECT * FROM users where id='$user_id'";
    $run=mysqli_query($conn,$sql);
    $data=mysqli_fetch_assoc($run);
?>

<form action="form_action.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $data['id']; ?>" />
    <input type="text" name="name" value="<?php echo $data['name']; ?>" />
    <input type="email" name="email" value="<?php echo $data['email']; ?>" />
    <input type="text" name="gender" value="<?php echo $data['gender']; ?> " />
    <input type="text" name="quali" value="<?php echo $data['qualification'] ?> " />
    <input type="submit" value="submit" name="updateDetails"/>
</form>