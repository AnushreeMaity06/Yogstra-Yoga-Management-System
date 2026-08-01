<?php
include('user_class_function.php');
session_start();



if ($_SERVER['REQUEST_METHOD'] === "POST" &&  $_POST['edit_btn']=='user') {
// print_r($_POST);
    
    $id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];   
    $gender = $_POST['gender'];
     // $quali = $_POST['quali'];
    $ph_no = $_POST['ph_no'];
    $address = $_POST['address'];
    
    

    if(!empty($_FILES['image']['name'])){
            $file_name = $_FILES['image']['name'];
            $tempname = $_FILES['image']['tmp_name'];
            $folder = 'image/'.$file_name;

            move_uploaded_file($tempname, $folder);
    }
    else{
    $file_name = $_POST['old_image']; // hidden input থেকে নাও
}
    

    // proper parameters pass
   $calls = edit_data('users', $id, $name, $email, $gender, $ph_no, $address, $file_name);

    if ($calls) {
        $_SESSION['user_name'] = $name;
        echo "<script>
            alert('User updated successfully');
            window.location.href = 'user_class.php';
        </script>";
    } else {
        echo "<script>
            alert('User update failed');
            window.location.href = 'user_class.php';
        </script>";
    }
}
?>