<?php
include('../db_connect.php');
global $conn;


// ===============loginpage================
session_start();
if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['loginBtn'])){
        $email=$_POST['email'];
        $password=$_POST['password'];

        // $image=$_POST['image'];
        // $file_name = $_FILES['image']['name'];
        // $tempname = $_FILES['image']['tmp_name'];
        // $folder = 'images/'.$file_name;
        // move_uploaded_file($tempname, $folder);

        $cehck="SELECT * FROM `admin` WHERE email_id='$email'";
        $run=mysqli_query($conn,$cehck);

        if(mysqli_num_rows($run)>0){
            $data=mysqli_fetch_assoc($run);
            if($data['password']===md5($password)){
                $_SESSION['user_id']=$data['id'];
                $_SESSION['user_name']=$data['name'];
                $_SESSION['user_email']=$data['email_id'];
                $_SESSION['user_gen']=$data['gender'];

                header("Location:overview.php");
                exit();
            }
            else{
                    echo "<script>
                    alert('Password did not match');
                    window.location.href='index.php';
                    </script>";
            }
            
        }
        else{
            echo "<script>
            alert('Email not exists');
         window.location.href='index.php';
            </script>";
        
        }
        
}
    

    ?>